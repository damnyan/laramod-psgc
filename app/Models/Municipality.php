<?php

namespace Modules\PSGC\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PSGC\Database\Factories\MunicipalityFactory;
use Modules\PSGC\Models\Traits\NameQueryable;

class Municipality extends Model
{
    use HasFactory;
    use NameQueryable;

    protected $table = 'psgc_municipalities';

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * Factory
     *
     * @return MunicipalityFactory
     */
    protected static function newFactory(): MunicipalityFactory
    {
        return MunicipalityFactory::new();
    }

    /**
     * Scope province
     *
     * @param Builder $query
     * @param array|string|null $provinceCode
     * @return Builder
     */
    public function scopeProvince(Builder $query, array|string|null $provinceCode = []): Builder
    {
        if (empty($provinceCode)) {
            return $query;
        }

        $provinceCode = (array) $provinceCode;

        return $query->whereIn('province_code', $provinceCode);
    }
}
