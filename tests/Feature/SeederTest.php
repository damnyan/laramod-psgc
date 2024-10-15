<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PSGC\Database\Seeders\PSGCDatabaseSeeder;
use Modules\PSGC\Models\Barangay;
use Modules\PSGC\Models\Municipality;
use Modules\PSGC\Models\Province;
use Modules\PSGC\Models\Region;

uses(
    RefreshDatabase::class,
);

it('should seed address', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan(
        'db:seed',
        ['--class' => PSGCDatabaseSeeder::class],
    )->assertExitCode(0);
    // $regionCount = Region::count(); // 18
    // $provinceCount = Province::count(); // 82
    // $municipalityCount = Municipality::count(); // 1655
    // $barangayCount = Barangay::count(); // 42004

    // expect($regionCount)->toBe(18);
    // expect($provinceCount)->toBe(82);
    // expect($municipalityCount)->toBe(1655);
    // expect($barangayCount)->toBe(42004);
});

it('should not seed address', function () {
    /** @var \Tests\TestCase $this */
    Region::factory()
        ->create();
    $this->artisan(command: 'db:seed', parameters: ['--class' => PSGCDatabaseSeeder::class]);

    $this->assertEquals(1, Region::count());
    $this->assertEquals(0, Province::count());
});
