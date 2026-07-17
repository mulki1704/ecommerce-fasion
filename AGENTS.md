# AGENTS.md

## Project

E-commerce fashion application. Laravel 10 skeleton — no custom models, controllers, or migrations yet.

## Stack

- **PHP 8.1+** / Laravel 10
- **MySQL** — database `fasion` on `127.0.0.1:3306`, user `root`, no password
- **Vite 5** with `laravel-vite-plugin` — entry points: `resources/css/app.css`, `resources/js/app.js`
- **Laravel Sanctum** for API auth
- **Laragon** local dev server (Windows)

## Commands

```bash
# Backend
php artisan serve          # Start dev server
php artisan migrate        # Run migrations
php artisan db:seed        # Seed database
php artisan test           # Run all tests
php artisan test --filter=TestName   # Run single test

# Code style
./vendor/bin/pint          # Auto-fix PHP code style (Laravel Pint)

# Frontend
npm run dev                # Start Vite dev server
npm run build              # Build production assets
```

## Testing

- PHPUnit 10, suites: `tests/Unit`, `tests/Feature`
- Test env uses array cache/session/mail, sync queue, `APP_ENV=testing`
- SQLite in-memory is commented out in `phpunit.xml` — enable it if you need fast isolated DB tests

## Code Style

- `laravel/pint` — run before committing; config in `composer.json` (no separate `pint.json`)
- 4-space indent, UTF-8, LF line endings (`.editorconfig`)

## Structure

```
app/Models/       # Eloquent models (currently only User)
app/Http/Controllers/
routes/web.php    # Web routes
routes/api.php    # API routes (Sanctum-protected)
database/migrations/
database/seeders/
tests/            # PHPUnit tests
resources/views/  # Blade templates
```

## Gotchas

- `.env` already has `APP_KEY` set — don't regenerate unless needed
- Database name is `fasion` (not `fashion`) — match this in any DB tooling
- No Docker or CI config exists yet
