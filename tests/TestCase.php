<?php

namespace JeffersonGoncalves\FakeCartoons\Tests;

use JeffersonGoncalves\FakeCartoons\FakeCartoonsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FakeCartoonsServiceProvider::class,
        ];
    }
}
