# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

**PHP / Backend**
```bash
composer format                 # Auto-format PHP code (PHP-CS-Fixer)
vendor/bin/phpunit              # Run full test suite
vendor/bin/phpunit --filter TestName   # Run a single test (tests use PHPUnit 12 `#[Test]` attributes, not `@test` annotations)
php artisan migrate             # Run database migrations
php artisan storage:link        # Link public storage (auto-runs on install/update)
```

**Frontend**
```bash
npm run dev                     # Build assets (development)
npm run prod                    # Build assets (production)
npm run watch                   # Watch + rebuild on change
```

**CI runs** PHP 8.5 on Ubuntu with Puppeteer and `chrome-headless-shell` installed; mirror that locally for screenshot tests (`npx puppeteer browsers install chrome-headless-shell`).

## Architecture

Screeenly is a Laravel 13 screenshot-as-a-service app (PHP 8.5 or newer). The app uses the slim bootstrap structure: middleware, exception handling, routing and the scheduler are configured in `bootstrap/app.php`, providers are listed in `bootstrap/providers.php`. There are no HTTP or Console kernels. The core feature logic lives in `/modules/Screeenly/` rather than `/app/` — that namespace is the primary place to work.

### Request flow (API)

```
POST /api/v1/fullsize  or  /api/v2/screenshot
  → ScreenshotController  (modules/Screeenly/Http/Controllers/Api/)
  → CreateScreenshotRequest  (validation)
  → CaptureService  (modules/Screeenly/Services/)
  → ChromeBrowser  or  AwsBrowser  (selected via DI binding in ScreeenlyServiceProvider)
  → Spatie Browsershot + Puppeteer
  → saved to SCREEENLY_DISK (local public or S3)
  → JSON response: screenshot URL + metadata
```

### Key directories

| Path | Purpose |
|---|---|
| `modules/Screeenly/Services/` | Core business logic — `CaptureService`, `ChromeBrowser`, `AwsBrowser`, `InMemoryBrowser` |
| `modules/Screeenly/Contracts/` | `CanCaptureScreenshot` interface — the abstraction point for swapping browser backends |
| `modules/Screeenly/Entities/` | Value objects: `Url`, `Screenshot` |
| `modules/Screeenly/Http/Controllers/Api/` | API v1 and v2 controllers |
| `modules/Screeenly/Http/Controllers/App/` | Web UI: dashboard, settings, OAuth |
| `modules/Screeenly/Guards/` | `ScreeenlyTokenGuard` — custom auth guard for API key authentication |
| `modules/Screeenly/Providers/ScreeenlyServiceProvider.php` | Binds `CanCaptureScreenshot` to the correct browser implementation |
| `config/screeenly.php` | App-specific config: sandbox, disk, Lambda mode |
| `tests/Feature/`, `tests/Unit/` | PHPUnit tests (`Tests\` namespace) |

### Dual browser backends

- **Local** (`ChromeBrowser`): uses `spatie/browsershot` + local Puppeteer/Node.
- **Lambda** (`AwsBrowser`): uses `hammerstone/sidecar` to invoke AWS Lambda — enabled via `SCREEENLY_USE_AWS_LAMBDA_BROWSER=true`.
- **Test** (`InMemoryBrowser`): used in tests; bound automatically when `APP_ENV=testing`.

The binding is resolved in `ScreeenlyServiceProvider`. To add a new backend, implement `CanCaptureScreenshot` and register it there.

### API versioning

v1 and v2 API controllers coexist under `modules/Screeenly/Http/Controllers/Api/`. v2 is the current preferred API.

### Authentication

Two guards:
- `web` — standard Laravel session auth; used for the dashboard. GitHub OAuth via `laravel/socialite`.
- `screeenly-token` — custom guard in `modules/Screeenly/Guards/`; validates `Authorization: Bearer <api-key>` headers against the `ApiKey` model.

### Code style

PHP-CS-Fixer config at `.php-cs-fixer.dist.php`: PSR-2, short arrays, ordered imports, return type declarations. Run `composer format` before committing.

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.5. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `yarn run build` or ask the user to run `yarn run dev` or `composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.
- Activate the `deploying-to-cloud` skill whenever deploying to Laravel Cloud, configuring Cloud environments or resources, using the Cloud CLI, or troubleshooting Cloud deployments.

=== tests rules ===

# Test Enforcement

- Add or update tests for behavior and logic changes when a test provides meaningful regression coverage.
- Pure copy, styling, and layout-only changes do not require new or updated tests.
- When test coverage applies, run the affected tests and ensure they pass.
- Test the changed behavior and its important failure modes, but do not add tests beyond them.
- Read the `testing-best-practices` skill before writing tests.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== phpunit/core rules ===

# PHPUnit

- This project uses PHPUnit. Create tests with `php artisan make:test --phpunit {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/phpunit` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

</laravel-boost-guidelines>
