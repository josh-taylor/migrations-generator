# Migrations Generator [![Build Status](https://travis-ci.org/josh-taylor/migrations-generator.svg?branch=master)](https://travis-ci.org/josh-taylor/migrations-generator)

Generate migrations from an existing database. Ideal for use when migrating an app to Laravel.

Please note, this is still really a work in progress. Worth noting the [things left to do below](https://github.com/josh-taylor/migrations-generator/#still-left-to-do).

## Installation

### Step 1: Composer

From the command line run:

```
composer require josh-taylor/migrations-generator --dev
```

### Step 2: Service Provider

For your Laravel app, you will only want these commands available during development, open `app/Providers\AppServiceProvider.php` and add in to the `register()` method:

```
if ($this->app->environment() == 'local') {
  $this->app->register('JoshTaylor\MigrationsGenerator\MigrationsGeneratorServiceProvider');
}
```

## Usage

Run from the command line:

```
php artisan migrate:generate
```

Bask in the glory of all these migrations created for you.

## Still left to do:

- `$table->increments()` and `$table->timestamps()` are always added. (May require moving away from [laracasts/Laravel-5-Generators-Extended](https://github.com/laracasts/Laravel-5-Generators-Extended))
- Column length is not generated (See above, plus issues with DBAL)
- [...](https://github.com/josh-taylor/migrations-generator/issues)
