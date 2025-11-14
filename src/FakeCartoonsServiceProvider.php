<?php

namespace JeffersonGoncalves\FakeCartoons;

use Faker\Generator;
use JeffersonGoncalves\FakeCartoons\Faker\CartoonCompanyProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
