<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PSGC\Models\Barangay;

uses(
    RefreshDatabase::class,
);

it('should get full addrss from barangay', function () {
    /** @var \Tests\TestCase $this */
    $barangay = Barangay::factory()->create();

    expect($barangay->full)->toBeString();
});
