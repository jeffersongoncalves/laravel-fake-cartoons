## Laravel Fake Cartoons

### Overview

Laravel Fake Cartoons is a Faker provider package that adds cartoon company name generation
to Laravel's Faker instance. It auto-registers via `FakeCartoonsServiceProvider` and extends
`Faker\Provider\Base` with a `CartoonCompanyProvider`.

### Key Concepts

- **Auto-registration**: The provider is added to Faker via `$app->resolving(Generator::class)` in the service provider
- **No configuration needed**: The package has zero config files; it works out of the box
- **Spatie Package Tools**: Uses `PackageServiceProvider` from `spatie/laravel-package-tools`

### Available Faker Methods

@verbatim
<code-snippet name="cartoon-company-usage" lang="php">
// In factories, seeders, or tests
$faker->cartoonCompany(); // Returns a random cartoon company name

// Inside a Laravel factory definition
'company' => fake()->cartoonCompany(),
</code-snippet>
@endverbatim

### Available Company Names

The provider includes 19 fictional companies from popular cartoons:
ACME Corporation, Planet Express, Krusty Krab, Chum Bucket, Monsters Inc.,
Buy n Large, Springfield Nuclear Power Plant, Kwik-E-Mart, Pizza Planet,
Mom's Friendly Robot Company, Al's Toy Barn, Blips and Chitz,
Pawtucket Patriot Ale, Slurm, Insuricare, Moe's Tavern,
Wayne Enterprises, Stark Industries, Oscorp.

### Architecture

@verbatim
<code-snippet name="provider-class" lang="php">
// src/Faker/CartoonCompanyProvider.php
// Extends Faker\Provider\Base
// Uses static::randomElement() for random selection

// src/FakeCartoonsServiceProvider.php
// Registers provider via packageRegistered() hook
// Resolves Faker\Generator and adds CartoonCompanyProvider
</code-snippet>
@endverbatim

### Namespace

@verbatim
<code-snippet name="namespace" lang="php">
// Main namespace
JeffersonGoncalves\FakeCartoons

// Faker provider
JeffersonGoncalves\FakeCartoons\Faker\CartoonCompanyProvider
</code-snippet>
@endverbatim

### Configuration

No configuration is required. The package auto-discovers via Laravel's package discovery
(`extra.laravel.providers` in `composer.json`).

### Conventions

- PHP 8.2+ required
- Compatible with Laravel 11, 12, and 13
- Uses Pest for testing, Pint for formatting, Larastan for static analysis
- The `cartoonCompany()` method always returns a `string`
- All company names are stored in a static array on the provider class
