# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
composer install                      # install PHP dependencies
php spark migrate                     # apply app/Database/Migrations (one baseline migration)
php spark db:seed DatabaseSeeder      # seed roles/tools/permissions + 4 demo accounts (see below)
php spark serve                       # run the dev server (serves public/ — do NOT point a server at the repo root)
vendor/bin/phpunit                    # run the full test suite
vendor/bin/phpunit tests/unit/HealthTest.php                  # run a single test file
vendor/bin/phpunit --filter testSomeMethodName tests/unit/...  # run a single test method
php -l path/to/File.php               # syntax-check a single PHP file (no linter is configured)
```

- `tests/unit/` and `tests/session/` run without a database.
- `tests/database/` (e.g. `AuthLoginTest`, which logs in as every seeded demo account through the real `/api/login` route) needs a **separate** MySQL/MariaDB database (`school_management_system_test`) because the schema uses MySQL-specific DDL that CodeIgniter's SQLite3 test default can't run. `DatabaseTestTrait` migrates and seeds it automatically on each run — see `.env`'s `database.tests.*` block and the main `README.md` for the one-time setup.
- Demo logins (seeded, non-production, safe for local testing): `admin@example.test`, `teacher@example.test`, `accountant@example.test`, `student@example.test`, all with password `DemoPass!123`. Never run the seeder against production.
- There is no JS/CSS build step — `public/assets/js/*.js` and `app/Views/**` are edited directly and served as-is.

## Architecture

### Two portals, one hand-rolled AJAX router, no SPA framework

There are two logged-in "SPA" shells, each rendered once on first page load and then driven by **`public/assets/js/spa-router.js`** (`window.SPARouter.init(options)`) for every subsequent navigation:

- `post-login-employee/*` — shared by **Admin, Teacher, and Accountant** logins (all three are "employee" `loginType`s; see Auth below). Shell: `app/Views/portal/post-login-employee.php`.
- `post-login-student/*` — student logins. Shell: `app/Views/portal/post-login-student.php`.

Every route under these prefixes is `POST`-only and returns an HTML **fragment** (not a full document) that `spa-router.js`'s `navigateTo()` injects into `<div id="app">` via jQuery `.html()`. The only true full-page GET load is the initial shell render in `PostLoginController`.

**Critical invariant:** the per-portal header view (`templates/header-student.php` / the employee equivalent) — which carries the `<script>` tags for jQuery/Bootstrap — must be rendered **exactly once**, on that initial full-page load, and never re-embedded in a per-route fragment. If it's duplicated into a fragment, `.html()` re-executes those `<script>` tags, and Bootstrap's bundle re-registers its delegated dropdown/tab click listeners — each additional load flips whether a dropdown toggle fires an even or odd number of times, so UI elements appear to "randomly" stop responding after some number of navigations. This exact bug has recurred twice in this codebase (student portal topbar dropdown, employee document-approval dropdown) — if a dropdown/toggle "breaks after navigating" instead of being broken from the start, suspect double script execution before anything else.

Page-fragment controllers live in `app/Controllers/Web/*ModulePages/` and typically return a concatenation like `view('templates/sidebar...') . view('templates/topbar...') . view('pages/.../some-page')` — note **no** header view in that chain for ordinary fragments.

### DataTables inside Bootstrap tabs/pills

Several pages put a DataTable (`responsive: true`) inside a non-default Bootstrap tab pane (`display:none` until shown). DataTables measures column widths at init time, so initializing while hidden locks in a near-zero width and visibly collapses the page layout the moment the tab is opened. `spa-router.js`'s global `shown.bs.tab` handler re-adjusts/recalcs any DataTable inside the pane that just became visible — if you add a new DataTable+tabs combination, it's already covered by that handler, but if dropdowns/widths look wrong on first tab-open, that's the mechanism to check.

Related: a Bootstrap dropdown whose toggle button lives inside a horizontally-scrollable container (e.g. a DataTables wrapper with `overflow-x: auto`) will toggle (`show` class added) but render invisible, clipped by the ancestor's overflow — Popper's default `position: absolute` strategy doesn't escape that. Fix pattern: mark the toggle `data-bs-strategy="fixed"` and instantiate it explicitly with `popperConfig: (cfg) => ({...cfg, strategy: 'fixed'})` (see `public/assets/js/employee-details.js`) rather than relying on Bootstrap's lazy auto-init.

### Controller split: Web vs Data

- `app/Controllers/Web/*ModulePages/*Controller.php` — thin HTTP controllers. Read `$this->request`, call a Data controller, `json_encode()` the result for AJAX endpoints or concatenate `view()` calls for page fragments. Auth/authorization checks belong here (see below), not in the Data layer.
- `app/Controllers/Data/*ModulePages/*Controller.php` — the actual business logic / query layer, instantiated directly (`new XController()`) by the Web controllers, not via DI. This is where to add new queries or data shaping.

### Auth and authorization

- JWT-based (`app/Filters/JWTAuthFilter.php`), applied globally except an explicit skip-list (`pre-login`, `login`, `forgot-password`, `privacy-policy`, `fees`, `api`). The filter resolves the token to either an `EmployeesModel` or `StudentsModel` row and attaches it as `$request->user = (object)['id','loginType','token','record']` — `record` is the full DB row (array), including `role_id` for employees. This is the **only** auth state controllers should use.
- The filter only checks "is this a valid employee/student token", **not** the employee's role. Role-based authorization is the controller's job: `BaseController` provides `isAdmin()`, `isAdminOrSelf($employeeId)`, `requireAdmin()`, `requireAdminOrSelf($employeeId)` (the last two return a 403 JSON response to `return` directly from an AJAX action, or `null` to proceed). Use these whenever adding an endpoint that should be Admin-only or "Admin or the employee themselves" — do not assume the frontend hiding a button is sufficient, since `post-login-employee/*` AJAX endpoints are reachable by any authenticated employee (Admin, Teacher, or Accountant) regardless of which sidebar links happen to be visible to them.
- Passwords: `password_hash()` on write; `BaseController::verifyAndUpgradePassword()` also accepts a legacy plaintext match and silently upgrades it to a hash on successful login.

### Database

- `app/Database/Migrations/2026-09-24-000000_InitialSchema.php` is a single baseline migration reverse-engineered from a production dump (the schema predates migrations existing at all). Add further schema changes as new migrations on top of it — don't edit it in place.
- `app/Database/Seeds/DatabaseSeeder.php` seeds roles/tools/role_permissions, a few classes/sections/subjects, and the four demo accounts listed above.
- Not every table in the schema has a UI/controller wired to it yet (e.g. `teacher_attendance` exists with a model but nothing currently writes to it) — check for an existing Model/usage before assuming a feature doesn't exist, but also don't assume a table being present means the feature is finished.

## Repository structure

- `app/Controllers/Web/*ModulePages` — page controllers that render the fragments the AJAX router swaps into `#app`
- `app/Controllers/Data` — business logic / data access, called from the Web controllers
- `app/Views/portal` — the two SPA shells described above
- `app/Views/pages` — the individual page fragments loaded into the shells
- `public/assets/js/spa-router.js` — the shared navigation engine for both portals; start here for any navigation/dropdown/tab/DataTable misbehavior before suspecting the PHP side
