---
name: fake-cartoons-development
description: Development guide for the Laravel Fake Cartoons package - a Faker provider for generating fictional cartoon company names
---

## When to use this skill

- Adding new cartoon company names to the provider
- Creating new Faker providers following the same pattern (e.g., cartoon characters, locations)
- Writing tests for Faker providers
- Understanding how the auto-registration mechanism works with Laravel's service container

## Setup

### Requirements

- PHP 8.2 or 8.3
- Laravel 11, 12, or 13
- spatie/laravel-package-tools ^1.14.0

### Installation

```bash
composer require jeffersongoncalves/laravel-fake-cartoons
```

No additional setup is needed. The package auto-discovers via Laravel's package discovery.

## Architecture

### Namespace Structure

```
JeffersonGoncalves\FakeCartoons\
    FakeCartoonsServiceProvider    # Main service provider
    Faker\
        CartoonCompanyProvider     # Faker provider with cartoon companies
```

### Service Provider

The `FakeCartoonsServiceProvider` extends Spatie's `PackageServiceProvider` and registers
the Faker provider automatically:

```php
// src/FakeCartoonsServiceProvider.php
class FakeCartoonsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-fake-cartoons');
    }

    public function packageRegistered(): void
    {
        $this->app->resolving(Generator::class, function (Generator $faker) {
            $faker->addProvider(new CartoonCompanyProvider($faker));
        });
    }
}
```

The `resolving` callback ensures the provider is added every time a `Faker\Generator`
instance is resolved from the container, including in factories and tests.

### CartoonCompanyProvider

The provider extends `Faker\Provider\Base` and exposes a single method:

```php
// src/Faker/CartoonCompanyProvider.php
class CartoonCompanyProvider extends Base
{
    protected static $cartoonCompanies = [
        'ACME Corporation',
        'Planet Express',
        'Krusty Krab',
        'Chum Bucket',
        'Monsters, Inc.',
        'Buy n Large',
        'Springfield Nuclear Power Plant',
        'Kwik-E-Mart',
        'Pizza Planet',
        "Mom's Friendly Robot Company",
        "Al's Toy Barn",
        'Blips and Chitz',
        'Pawtucket Patriot Ale',
        'Slurm',
        'Insuricare',
        "Moe's Tavern",
        'Wayne Enterprises',
        'Stark Industries',
        'Oscorp',
    ];

    public function cartoonCompany(): string
    {
        return static::randomElement(static::$cartoonCompanies);
    }
}
```

## Features

### Using in Factories

```php
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->cartoonCompany(),
            'email' => fake()->companyEmail(),
        ];
    }
}
```

### Using in Seeders

```php
use Faker\Generator;

class CompanySeeder extends Seeder
{
    public function run(Generator $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            Company::create([
                'name' => $faker->cartoonCompany(),
            ]);
        }
    }
}
```

### Using in Tests

```php
it('generates a cartoon company name', function () {
    $name = fake()->cartoonCompany();

    expect($name)->toBeString()->not->toBeEmpty();
});
```

### Adding New Providers

To add a new provider following the same pattern:

1. Create a new class extending `Faker\Provider\Base`
2. Add a static array of values
3. Create a method that calls `static::randomElement()`
4. Register the provider in `FakeCartoonsServiceProvider::packageRegistered()`

```php
// Example: CartoonCharacterProvider
class CartoonCharacterProvider extends Base
{
    protected static $characters = ['Bugs Bunny', 'Homer Simpson', ...];

    public function cartoonCharacter(): string
    {
        return static::randomElement(static::$characters);
    }
}
```

## Configuration

This package has no configuration file. It works out of the box with zero setup.

## Testing Patterns

### Testing the Provider Directly

```php
use JeffersonGoncalves\FakeCartoons\Faker\CartoonCompanyProvider;
use Faker\Generator;

it('returns a string from the cartoon companies list', function () {
    $faker = new Generator();
    $faker->addProvider(new CartoonCompanyProvider($faker));

    $company = $faker->cartoonCompany();

    expect($company)->toBeString();
    expect($company)->toBeIn([
        'ACME Corporation',
        'Planet Express',
        'Krusty Krab',
        // ... all 19 entries
    ]);
});
```

### Testing Auto-Registration

```php
it('auto-registers the provider with Laravel Faker', function () {
    $company = fake()->cartoonCompany();

    expect($company)->toBeString()->not->toBeEmpty();
});
```

### Dev Commands

```bash
# Run tests
vendor/bin/pest

# Run static analysis
vendor/bin/phpstan analyse

# Format code
vendor/bin/pint
```
