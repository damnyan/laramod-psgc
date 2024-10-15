<?php

namespace Modules\PSGC\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PSGC\Models\Traits\NameQueryable;
use Modules\PSGC\Database\Factories\ProvinceFactory;

class Province extends Model
{
    use HasFactory;
    use NameQueryable;

    protected $table = 'psgc_provinces';

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * Factory
     *
     * @return ProvinceFactory
     */
    protected static function newFactory(): ProvinceFactory
    {
        return ProvinceFactory::new();
    }

    /**
     * Scope region
     *
     * @param Builder $query
     * @param array|string|null $regionCode
     * @return Builder
     */
    public function scopeRegion(Builder $query, array|string|null $regionCode = []): Builder
    {
        if (empty($regionCode)) {
            return $query;
        }

        $regionCode = (array) $regionCode;

        return $query->whereIn('region_code', $regionCode);
    }
}
