<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PSGC\Models\Barangay;
use Modules\PSGC\Models\Municipality;
use Modules\PSGC\Models\Province;
use Modules\PSGC\Models\Region;

uses(
    RefreshDatabase::class,
);

dataset('filters', [
    [null],
    ['test'],
    ['']
]);

it('should list regions', function () {
    /** @var \Tests\TestCase $this */
    Region::factory()
        ->create();

    $response = $this->getJson(
        uri: route(
            name: 'api.psgc.region',
        ),
    );

    $response->assertOk();
});

it('should get list of provinces', function ($filter) {
    /** @var \Tests\TestCase $this */
    Province::factory(count: 10)
        ->create();

    $response = $this->getJson(
        uri: route(
            name: 'api.psgc.province',
            parameters: ['region_code' => $filter, 'q' => $filter],
        ),
    );

    $response->assertOk();
})->with('filters');

it('should get list of municipalities', function ($filter) {
    /** @var \Tests\TestCase $this */
    Municipality::factory(count: 10)
        ->create();

    $response = $this->getJson(
        uri: route(
            name: 'api.psgc.municipality',
            parameters: ['province_code' => $filter, 'q' => $filter]
        ),
    );

    $response->assertOk();
})->with('filters');

it('should get list of barangays', function ($filter) {
    /** @var \Tests\TestCase $this */
    Barangay::factory(count: 10)
        ->create();

    $response = $this->getJson(
        uri: route(
            name: 'api.psgc.barangay',
            parameters: ['municipality_code' => $filter, 'q' => $filter]
        ),
    );

    $response->assertOk();
})->with('filters');
