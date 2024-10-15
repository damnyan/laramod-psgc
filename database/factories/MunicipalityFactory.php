<?php

namespace Modules\PSGC\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PSGC\Models\Municipality;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Municipality>
 */
class MunicipalityFactory extends Factory
{
    protected $model = Municipality::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'region_code' => 'region-code',
            'region_name' => 'Region Name',
            'province_code' => 'province-code',
            'province_name' => 'Province Name',
            'code' => $this->faker->lexify(),
            'name' => $this->faker->name,
        ];
    }
}
