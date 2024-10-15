<?php

namespace Modules\PSGC\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Modules\PSGC\Enums\Country;
use Modules\PSGC\Models\Barangay;
use Modules\PSGC\Objects\Address as ObjectsAddress;

class Address implements CastsAttributes
{
    /**
     * Get
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $address = json_decode($value, true);
        return new ObjectsAddress(
            country: Country::tryFrom($address['country'] ?? null),
            barangay: Barangay::find($address['barangay_code']),
            line_1: $address['line_1'] ?? null,
            line_2: $address['line_2'] ?? null,
            postalCode: $address['postal_code'] ?? null,
        );
    }

    /**
     * Set
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        return [$key => json_encode($value->toArray())];
    }
}
