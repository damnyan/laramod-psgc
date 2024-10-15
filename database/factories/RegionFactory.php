<?php

namespace Modules\PSGC\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PSGC\Models\Region;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->lexify(),
            'name' => $this->faker->city,
        ];
    }
}
