<?php

namespace JeffersonGoncalves\FakeCartoons\Faker;

use Faker\Provider\Base;

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
