<?php

use JeffersonGoncalves\FakeCartoons\Faker\CartoonCompanyProvider;

it('generates a cartoon company name as a string', function () {
    expect(fake()->cartoonCompany())->toBeString()->not->toBeEmpty();
});

it('returns a value from the predefined cartoon company list', function () {
    $reflection = new ReflectionClass(CartoonCompanyProvider::class);
    $companies = $reflection->getStaticPropertyValue('cartoonCompanies');

    expect($companies)->toContain(fake()->cartoonCompany());
});

it('always returns a value from the list across many calls', function () {
    $reflection = new ReflectionClass(CartoonCompanyProvider::class);
    $companies = $reflection->getStaticPropertyValue('cartoonCompanies');

    foreach (range(1, 50) as $ignored) {
        expect($companies)->toContain(fake()->cartoonCompany());
    }
});
