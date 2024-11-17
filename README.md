
# Grebban Product API

Test project for Grebban.

## Development Plan

1. Break down the problem. Write a plan.
2. Install Laravel
3. Write a simple HTTP test for the API response according to spec.
4. Create Laravel data objects that map to the two types.
5. Create actions to fetch and parse the data.
6. Map attributes to products. Data Transformer?
7. Create route + controller
8. Adjust data objects so that the response formats according to spec. Make the tests pass.
9. Optionally, write tests for the actions.

## Technologies used:

Laravel 11

Packages used:
- [Laravel Data](https://github.com/spatie/laravel-data)
- [Sushi](https://github.com/calebporzio/sushi)
- [Laravel Pint](https://github.com/laravel/pint)
- [Laravel Pest](https://github.com/pestphp/pest)

## Requirements

- PHP 8.3
- No database needed for this project, but the Sushi package uses a SQLite database under the hood and needs the [`pdo-sqlite` PHP extension](https://www.php.net/manual/en/ref.pdo-sqlite.php).

## Setup

1. `cp .env.example .env`
2. `composer install`
3. `php artisan serve`
4. `open http://127.0.0.1:8001/product`

## Code checks and Testing

### Code check
This runs Laravel Pint, Laravel Pest and Pest Type Coverage.
```bash
composer check
```

### Run tests
Runs test suite
```bash
composer test
```
Runs test suite with text coverage summary (requires a code coverage driver like xDebug or pcov)
```bash
composer coverage
```
