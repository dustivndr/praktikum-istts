# Copilot instructions

## Project overview

`bemabsensi` is a Laravel 13 application using PHP 8.3+, Eloquent, Blade, Vite, and Tailwind CSS 4.

- Application bootstrap and route registration are in `bootstrap/app.php`. Web routes are loaded from `routes/web.php`; console commands belong in `routes/console.php`.
- Domain code follows Laravel's default layers: models in `app/Models`, controllers in `app/Http/Controllers`, migrations and seeders in `database`, and Blade templates in `resources/views`.
- The current web surface is intentionally minimal: `/` returns the `welcome` Blade view. Add feature routes in `routes/web.php` and move non-trivial request handling into controllers rather than route closures.
- Frontend assets start at `resources/css/app.css` and `resources/js/app.js`, are bundled by Vite, and are included in Blade with `@vite`. Tailwind is configured through the Vite plugin and CSS `@import 'tailwindcss'`.
- Database configuration defaults to SQLite in `.env.example`. Schema changes belong in timestamped migrations; tests use an in-memory SQLite database configured in `phpunit.xml`.
- Feature tests extend `Tests\TestCase` and exercise the Laravel application; unit tests extend `PHPUnit\Framework\TestCase` for framework-independent code.

## Setup and development commands

Run these commands from `bemabsensi/`:

```sh
composer install
copy .env.example .env       # Windows; use cp on Unix
php artisan key:generate
php artisan migrate
npm install
```

The Composer `setup` script performs the standard installation, environment initialization, migration, and frontend build:

```sh
composer run setup
```

Run the application and asset tooling separately when needed:

```sh
php artisan serve
npm run dev
```

Create a production frontend bundle with:

```sh
npm run build
```

`composer run dev` is also available for the project's combined Laravel development workflow.

## Tests and formatting

Run the complete test suite with either command:

```sh
composer test
php artisan test
```

Run one test file or filter one test method with:

```sh
php artisan test tests/Feature/ExampleTest.php
php artisan test --filter=test_the_application_returns_a_successful_response
```

PHP formatting uses Laravel Pint:

```sh
vendor/bin/pint
vendor/bin/pint --test
```

When changing frontend code, run `npm run build` in addition to the relevant PHP tests.

## Conventions specific to this repository

- Preserve Laravel 13's attribute-based model configuration. `User` uses `#[Fillable(...)]` and `#[Hidden(...)]`; use the corresponding Laravel attributes for new model metadata rather than reintroducing older property-based configuration without a reason.
- Keep password casting as `'hashed'` and treat sensitive model attributes as hidden from serialized output.
- Put shared middleware and exception behavior in `bootstrap/app.php`; it currently renders JSON for API-prefixed or JSON-expecting requests.
- Use the existing Vite entry points instead of adding ad-hoc scripts or stylesheets. Keep Tailwind source configuration in `resources/css/app.css` and Vite plugin configuration in `vite.config.js`.
- Use Laravel migrations for schema changes and keep test database assumptions compatible with SQLite/in-memory execution.
- Follow the existing test split: application behavior and HTTP/database interactions in `tests/Feature`; isolated PHP behavior in `tests/Unit`.
- Read `AGENTS.md` and `CLAUDE.md` before application changes. They require verifying PHP and Composer and, for application work, installing/configuring Laravel Boost with `composer require laravel/boost --dev` and `php artisan boost:install` before continuing.
