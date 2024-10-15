<?php

namespace Modules\PSGC\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\PSGC\Models\Barangay;
use Modules\PSGC\Models\Municipality;
use Modules\PSGC\Models\Province;
use Modules\PSGC\Models\Region;

class PSGCDatabaseSeeder extends Seeder
{
    protected $codeLength = 10;

    protected $padding = '0';

    protected $currentRegion = [
        'code' => '',
        'name' => '',
    ];

    protected $currentProvince = [
        'code' => '',
        'name' => '',
    ];

    protected $currentMunicipality = [
        'code' => '',
        'name' => '',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $file = __DIR__ . '/files/address.csv';

        if (config('app.env') === 'testing') {
            $file = __DIR__ . '/files/test.csv';
        }

        if (Region::count() > 0) {
            return;
        }

        ini_set('auto_detect_line_endings', true);
        $handle = fopen($file, 'r');
        while (($data = fgetcsv($handle)) !== false) {
            $this->insertToDb($data);
        }

        ini_set('auto_detect_line_endings', false);
    }

    /**
     * Insert to DB
     *
     * @param array $data
     *
     * @return void
     */
    private function insertToDb(array $data): void
    {
        $level = $data[3];
        if ($level == 'Reg') {
            $this->insertToRegion($data);
            return;
        }

        if (in_array($level, ['Prov', 'Dist'])) {
            $this->insertToProvince($data);
            return;
        }

        if (in_array($level, ['Mun', 'City', 'SubMun'])) {
            $this->insertToMunicipality($data);
            return;
        }

        if ($level == 'Bgy') {
            $this->insertToBarangay($data);
        }
    }

    /**
     * Insert to Region
     *
     * @param array $data
     *
     * @return void
     */
    private function insertToRegion(array $data): void
    {
        $code = $data[0];
        $name = $data[1];
        $this->currentRegion = [
            'code' => $code,
            'name' => $name,
        ];

        Region::create([
            'code' => $code,
            'name' => $name,
        ]);
    }

    /**
     * Insert To Province
     *
     * @param array $data
     *
     * @return void
     */
    private function insertToProvince(array $data): void
    {
        $code = empty($data[0]) ? str_pad(string: $data[2], length: 10, pad_string: '0') : $data[0];
        $name = $data[1];
        $this->currentProvince = [
            'code' => $code,
            'name' => $name,
        ];
        Province::create([
            'code' => $code,
            'region_code' => $this->currentRegion['code'],
            'region_name' => $this->currentRegion['name'],
            'name' => $name,
        ]);
    }

    /**
     * Insert to municipality
     *
     * @param array $data
     *
     * @return void
     */
    private function insertToMunicipality(array $data): void
    {
        $code = $data[0];
        $name = $data[1];
        // Skip City of Manila
        if ($code === '1380600000') {
            return;
        }
        $this->currentMunicipality = [
            'code' => $code,
            'name' => $name,
        ];

        Municipality::create([
            'code' => $code,
            'region_code' => $this->currentRegion['code'],
            'region_name' => $this->currentRegion['name'],
            'province_code' => $this->currentProvince['code'],
            'province_name' => $this->currentProvince['name'],
            'name' => $data[1],
        ]);
    }

    /**
     * Insert to barangay
     *
     * @param array $data
     *
     * @return void
     */
    private function insertToBarangay(array $data): void
    {
        $name = $data[1];

        Barangay::create([
            'code' => $data[0],
            'region_code' => $this->currentRegion['code'],
            'region_name' => $this->currentRegion['name'],
            'province_code' => $this->currentProvince['code'],
            'province_name' => $this->currentProvince['name'],
            'municipality_code' => $this->currentMunicipality['code'],
            'municipality_name' => $this->currentMunicipality['name'],
            'name' => $name,
        ]);
    }
}
