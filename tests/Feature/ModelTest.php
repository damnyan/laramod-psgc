<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PSGC\Casts\Address;
use Modules\PSGC\Enums\Country;
use Modules\PSGC\Models\Barangay;
use Modules\PSGC\Objects\Address as ObjectsAddress;

uses(
    RefreshDatabase::class,
);

it('should get full addrss from barangay', function () {
    /** @var \Tests\TestCase $this */
    $barangay = Barangay::factory()->create();

    expect($barangay->full)->toBeString();
});

it('should cast address', function () {
    /** @var \Tests\TestCase $this */
    $model = new class extends Model {
        protected $fillable = [
            'address',
            'name',
        ];

        protected function casts(): array
        {
            return [
                'address' => Address::class,
            ];
        }
    };

    $model->name = 'asdf';
    // $model->address = 'asdf';
    $barangay = Barangay::factory()->create();
    $address = new ObjectsAddress(
        country: Country::PHILIPPINES,
        barangay: $barangay,
        line_1: 'line 1',
        line_2: 'line 2',
        postalCode: '1234',
    );
    $model->address = $address;

    expect($model->toArray()['address'])->toBeInstanceOf(ObjectsAddress::class);
    expect($model->address->full())->toBeString();
    expect($model['address']->full())->toBeString();
});

it('should get on address casts', function () {
    /** @var \Tests\TestCase $this */
    $casts = new Address();
    $model = new class extends Model {};
    $barangay = Barangay::factory()->create();

    $object = $casts->get(
        model: $model,
        key: 'address',
        value: json_encode([
            'country' => Country::PHILIPPINES->value,
            'barangay_code' => $barangay->code,
            'line_1' => 'line 1',
            'line_2' => 'line 2',
            'postal_code' => '1234',
        ]),
        attributes: []
    );

    expect($object)->toBeInstanceOf(ObjectsAddress::class);
});
