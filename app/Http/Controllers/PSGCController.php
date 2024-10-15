<?php

namespace Modules\PSGC\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Common\Http\Controllers\Controller;
use Modules\PSGC\Http\Resources\BarangayResource;
use Modules\PSGC\Http\Resources\MunicipalityResource;
use Modules\PSGC\Http\Resources\ProvinceResource;
use Modules\PSGC\Http\Resources\RegionResource;
use Modules\PSGC\Models\Barangay;
use Modules\PSGC\Models\Municipality;
use Modules\PSGC\Models\Province;
use Modules\PSGC\Models\Region;

class PSGCController extends Controller
{
        /**
     * Get Query
     *
     * @return void
     */
    protected function getQuery()
    {
        return request()->get('q', null);
    }

    /**
     * Region
     *
     * @return ResourceCollection
     */
    public function region(): ResourceCollection
    {
        $regions = Region::name($this->getQuery())
            ->paginate($this->getPerPage());

        return RegionResource::collection(resource: $regions);
    }

    /**
     * Province
     *
     * @return ResourceCollection
     */
    public function province(): ResourceCollection
    {
        $provinces = Province::name($this->getQuery())
            ->orderBy(column: 'name', direction: 'asc')
            ->region(request()->get('region_code', []))
            ->paginate($this->getPerPage());

        return ProvinceResource::collection(resource: $provinces);
    }

    /**
     * Municipality
     *
     * @return ResourceCollection
     */
    public function municipality(): ResourceCollection
    {
        $provinces = Municipality::name($this->getQuery())
            ->orderBy(column: 'name', direction: 'asc')
            ->province(request()->get('province_code', []))
            ->paginate($this->getPerPage());

        return MunicipalityResource::collection(resource: $provinces);
    }

    /**
     * Barangay
     *
     * @return ResourceCollection
     */
    public function barangay(): ResourceCollection
    {
        $provinces = Barangay::name($this->getQuery())
            ->orderBy(column: 'name', direction: 'asc')
            ->municipality(request()->get('municipality_code', []))
            ->paginate($this->getPerPage(default: 300));

        return BarangayResource::collection(resource: $provinces);
    }
}
