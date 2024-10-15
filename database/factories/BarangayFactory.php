<?php

namespace Modules\PSGC\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PSGC\Models\Barangay;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barangay>
 */
class BarangayFactory extends Factory
{
    protected $model = Barangay::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'region_code' => 'region-code',
            'region_name' => 'Region I (Ilocos Region)',
            'province_code' => 'province-code',
            'province_name' => 'Ilocos Norte',
            'municipality_code' => 'municipality-code',
            'municipality_name' => 'Adams',
            'code' => $this->faker->lexify(),
            'name' => 'Adams',
        ];
    }
}
