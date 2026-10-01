---
name: audit-module
description: Audit one module of this school-management-system-spa app (e.g. fees, academics, admissions, exams) for the same classes of bug already found and fixed in the student and employee portals — static/hardcoded demo data, broken dropdowns/tabs from the SPA router's known failure modes, dead routes/links, and missing role checks. Use when the user asks to "fix/review/check" a module, section, or portal area of this app.
---

# Auditing a module of this app

This app has already had two full audit-and-fix passes (student portal, then
employee portal — see `README.md`'s "Failure modes" list and `CLAUDE.md` for
what was found and why). The same handful of bug classes keep recurring
because they come from this app's specific architecture, not from the
business logic of any one module. When asked to audit/fix another module
(fees, academics, admissions, exams, attendance, ...), check for all of the
following rather than reading code in isolation.

## 1. Set up to actually see it run

Read `CLAUDE.md` and `README.md` first for the architecture and demo
accounts. Start the dev server (`.claude/launch.json` already has a
`school-management-system-spa` config — use `preview_start` with that name,
or check if the user already has `php spark serve` running on port 8080
before starting a second one) and log in with a seeded demo account
(`admin@example.test` / `DemoPass!123`, etc. — see README). Static analysis
alone will miss the live-rendering bugs below (collapsed layouts, invisible
dropdowns) — you have to actually click through the module's pages.

## 2. Grep for the recurring bug classes

- **Duplicated header include**: `grep -n "view('templates/header" app/Controllers/Web/<Module>Pages/*.php` — a page-fragment method (anything reached via AJAX navigation, not the one-time portal shell render in `PostLoginController`) should **never** include a header view. If it does, every navigation re-executes jQuery/Bootstrap and breaks dropdowns after some number of navigations (see README).
- **DataTable inside a non-default Bootstrap tab**: `grep -n "DataTable(" public/assets/js/<module>*.js` then check whether `#thatTableId` is selected by `spa-router.js`'s `dataTable` plugin and whether the table sits inside a `tab-pane` that isn't `show active`. The router's `shown.bs.tab` handler already recalcs these — only a problem for tables added *before* that handler existed, or wrapped by a different/custom init path.
- **Dropdown inside a scrollable container**: any `data-bs-toggle="dropdown"` whose closest ancestor has `overflow-x: auto`/`overflow: hidden` (typically a DataTables wrapper or a `.table-responsive` div) needs `data-bs-strategy="fixed"` plus a manual `new bootstrap.Dropdown(el, { popperConfig: ... })` init (see `public/assets/js/employee-details.js`) — the default lazy auto-init renders it invisible even though it does toggle open.
- **Hardcoded/mock data**: `grep -rniE "mock|dummy|for now" app/Controllers/Data/<Module>Pages/*.php` and look for template leftovers in views — a hardcoded `<tr>` demo row above a `DataTable({serverSide: true, ajax: ...})` call is dead markup the JS immediately overwrites (harmless but should be removed for a clean flash-free load); a controller computing fake stats (e.g. a hardcoded percentage) instead of querying is not harmless — check whether the computed real data is even used anywhere before assuming it should be wired up vs. just deleted as dead code.
- **Dead links/routes**: `grep -rn '\.html"' app/Views/pages/<module>...` for leftover links to template demo pages that don't exist in this app's routes, and cross-reference every `$routes->post(...)`/`get(...)` target against the actual controller method name (a renamed method with a stale route entry 404s silently since nothing links to it directly).

## 3. Check authorization, not just the happy path

All employee logins (Admin, Teacher, Accountant) share `post-login-employee/*`
and its AJAX endpoints — the JWT filter only checks "is this a valid employee
token", not role. Before assuming a module's admin-only-looking actions are
actually admin-only, test the endpoint directly as a non-admin demo account
(`teacher@example.test`), e.g. via `fetch()` in the browser console with
`credentials: "include"`. Use `BaseController::isAdmin()` /
`requireAdmin()` / `isAdminOrSelf($id)` / `requireAdminOrSelf($id)` to gate
anything that should be Admin-only or Admin-or-self — see
`AdminModuleController`'s employee/document/role methods for the pattern.
Don't blanket-lock a whole route group without checking: some modules may
legitimately need broader access (e.g. Accountant + fees) — if in doubt, ask
the user which role boundary they want before changing access control, since
getting it wrong either leaves a real gap or breaks a legitimate workflow.

## 4. Verify for real, then clean up test data

Use the browser to actually trigger the fixed interaction (open the
dropdown, submit the form, click the tab) rather than trusting the diff.
When verification needs rows that don't exist in the seed data, insert
minimal test fixtures directly via `mysql` (same local dev DB credentials
used by `.env`) rather than fabricating them through the UI where that's
slower, and delete them again afterward — don't leave QA data in the
database or `public/uploads/`.
