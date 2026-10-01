# School Management System (SPA)

A CodeIgniter 4 school management system (admissions, attendance, fees,
exams, employee/HR, transport, academics) with a server-rendered login page
and an AJAX-driven "SPA" shell for the logged-in employee and student
portals.

## Tech stack

- **Backend:** PHP / CodeIgniter 4, MySQL (MariaDB in production)
- **Frontend:** jQuery + a hand-rolled AJAX router (no framework — see below)
- **Auth:** JWT (`app/Filters/JWTAuthFilter.php`), applied globally to every
  route except an explicit skip-list (login, pre-login, forgot-password,
  privacy-policy, public fee receipts)

## The custom JS router

There is **no client-side routing library** in this project. Navigation
inside the logged-in portals is a hand-rolled AJAX router: `public/assets/js/spa-router.js`
exposes `window.SPARouter.init(options)`, and both portal shells

- `app/Views/portal/post-login-employee.php`
- `app/Views/portal/post-login-student.php`

call it with their own routes/plugin/customConfig data. This used to be
~1000 lines of `navigateTo()`/`AppState`/plugin-lifecycle/history-handling
code duplicated almost 1:1 in both files — a fix applied to one copy quietly
stayed broken in the other. That duplication is gone now; **if you're
debugging a navigation issue, start in `spa-router.js`**, not in the two
much smaller portal views (which are now just per-portal configuration) or
the PHP controllers.

Failure modes this router has already had (all fixed, all worth knowing
about since the pattern can recur):

- Browser back button doing nothing on the very first press (the initial
  page load never wrote a `history.pushState`/`replaceState` entry, so the
  first `popstate` had no `event.state` to act on).
- Navigation clicks silently dropped when they happened while another
  request was still in flight (the queued-navigation dequeue code existed
  but was commented out).
- The mobile hardware back button firing twice (Capacitor's `backButton`
  listener registered in two separate `DOMContentLoaded` blocks).
- A stray `document.addEventListener("backbutton", ...)` registered *inside*
  a chart-rendering function, so a new listener piled up every time that
  chart's route loaded, without ever being removed.
- A page's header view (the one carrying the jQuery/Bootstrap `<script>`
  tags) got re-embedded into a per-route AJAX fragment instead of being
  rendered only once on the true initial page load. Since `navigateTo()`
  injects fragments via jQuery `.html()` (which executes embedded
  `<script>` tags), this re-ran Bootstrap's bundle on every navigation,
  stacking up extra delegated dropdown click listeners — a dropdown would
  work right after a fresh page load and then stop responding (or
  intermittently work) after further navigation, depending on whether the
  accumulated listener count was even or odd. Fixed in both the student
  portal (topbar profile dropdown) and the employee portal (document
  approval dropdown); if a toggle/dropdown "breaks after navigating" rather
  than being broken from the start, check for a duplicated header include
  before anything else.
- A DataTable (`responsive: true`) initialized while its Bootstrap tab/pill
  pane was still `display:none` measured a near-zero container width and
  locked it in, collapsing the page layout the moment the tab was opened.
  The router's global `shown.bs.tab` handler now re-adjusts/recalcs any
  DataTable inside a pane as soon as it's shown — covers this automatically
  for new DataTable+tabs pages, but worth knowing if a table/layout looks
  broken only on a non-default tab.

If you add a new page fragment that needs `navigateTo(...)` as a global
(some do, e.g. `exam-details.php`, `employee-details.js`), it's exposed on
`window` from inside `SPARouter.init()` — see the comment above its
definition in `spa-router.js`.

## Setup (clone and run locally)

1. `composer install`
2. Copy `env` to `.env` and set at minimum:
   - `app.baseURL`
   - `database.default.*` (hostname, database, username, password) — point
     it at an empty local MySQL/MariaDB database you've created, e.g.
     `CREATE DATABASE school_management_system;`
   - `JWT_SECRET` (required — `JWTAuthFilter` decodes every authenticated
     request with this; there is no fallback). Generate one with
     `php -r "echo bin2hex(random_bytes(32));"`
3. `php spark migrate`
4. `php spark db:seed DatabaseSeeder`
5. `php spark serve` and log in with one of the demo accounts below

`index.php` lives in `public/`, not the project root — point your web
server's document root at `public/`.

### Database / migrations / seeders

`app/Database/Migrations` previously had no migrations at all even though
the production database has 39 tables — the schema only existed in the
live MySQL instance. A baseline migration
(`2026-09-24-000000_InitialSchema.php`) now reverse-engineers that schema
from a production dump, so a fresh environment can be provisioned with:

```
php spark migrate
php spark db:seed DatabaseSeeder
```

Add any further schema changes as new migrations on top of that baseline —
don't edit it in place.

`DatabaseSeeder` (`app/Database/Seeds/`) loads baseline lookup data (roles,
the admin "tools" tiles + role permissions, a couple of classes/sections/
subjects) plus four **fake, non-PII demo accounts** so you can actually log
in locally after a fresh clone:

| Login                    | Role       | Password       |
|---------------------------|------------|----------------|
| `admin@example.test`      | Admin      | `DemoPass!123` |
| `teacher@example.test`    | Teacher    | `DemoPass!123` |
| `accountant@example.test` | Accountant | `DemoPass!123` |
| `student@example.test`    | Student    | `DemoPass!123` |

Never run `DatabaseSeeder`/`DemoUsersSeeder` against production — it creates
these accounts with a published password.

### Auth notes

- Passwords are hashed with `password_hash()` on write. Older rows created
  before hashing was introduced are still plaintext; login verifies against
  either format and silently upgrades a plaintext row to a hash on
  successful login (see `BaseController::verifyAndUpgradePassword()`).
- Every route is behind the global `jwt` filter except the explicit
  skip-list in `JWTAuthFilter`. If you add a new route that should be
  public, add its first URI segment there rather than disabling the filter.
- The JWT filter only verifies "is this a valid employee/student token" —
  it does not check the employee's role. All three employee logins (Admin,
  Teacher, Accountant) share the same `post-login-employee/*` route tree and
  AJAX endpoints, so any authenticated employee can reach any
  `AdminModuleController` action unless the controller itself checks the
  role. Use `BaseController::isAdmin()` / `isAdminOrSelf($employeeId)` /
  `requireAdmin()` / `requireAdminOrSelf($employeeId)` for that — the
  latter two return a 403 JSON response you can `return` directly from an
  AJAX action. Employee-management CRUD, role management, and document
  approval (Verify/Reject) are Admin-only; profile/document self-service
  actions are Admin-or-self. Note this currently covers those specific
  actions, not full-page view-level access — e.g. the Admin Dashboard
  itself and its full sidebar are still reachable by any employee via
  direct URL.

## Running the test suite

```
vendor/bin/phpunit
```

`tests/unit/` runs without a database. `tests/database/` (e.g.
`AuthLoginTest`, which logs in as each seeded demo account through the real
`/api/login` route) needs a **separate** MySQL/MariaDB database, because the
schema migration uses MySQL-specific DDL that CodeIgniter's SQLite3 test
default can't run:

```sql
CREATE DATABASE school_management_system_test;
```

Then set in `.env` (see the commented block in `env` for the full copy —
note `database.tests.DBPrefix` is deliberately left **empty**, since
CodeIgniter's own default of `db_` for the tests group doesn't work against
raw-SQL migrations like this project's):

```
database.tests.hostname = 127.0.0.1
database.tests.database = school_management_system_test
database.tests.username = root
database.tests.password =
database.tests.DBDriver = MySQLi
database.tests.DBPrefix =
```

`AuthLoginTest` migrates and seeds this database automatically on each run
(`DatabaseTestTrait`) — it's disposable, drop and recreate it any time.

## Server requirements

PHP 8.1+, with the `intl`, `mbstring`, `json`, and `mysqlnd` extensions
enabled.

## Repository structure

- `app/Controllers/Web/*ModulePages` — page controllers that render the
  fragments the AJAX router swaps into `#app`
- `app/Controllers/Data` — business logic / data access, called from the
  Web controllers
- `app/Views/portal` — the two SPA shells described above
- `app/Views/pages` — the individual page fragments loaded into the shells
