<?php

namespace Modules\PSGC\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PSGC\Models\Province;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Province>
 */
class ProvinceFactory extends Factory
{
    protected $model = Province::class;

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
            'code' => $this->faker->lexify(),
            'name' => $this->faker->name,
        ];
    }
}
