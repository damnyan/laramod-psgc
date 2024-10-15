<?php

namespace Modules\PSGC\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PSGC\Database\Factories\BarangayFactory;
use Modules\PSGC\Models\Contracts\Barangay as ContractsBarangay;
use Modules\PSGC\Models\Traits\NameQueryable;

class Barangay extends Model implements ContractsBarangay
{
    use HasFactory;
    use NameQueryable;

    protected $table = 'psgc_barangays';

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * Factory
     *
     * @return BarangayFactory
     */
    protected static function newFactory(): BarangayFactory
    {
        return BarangayFactory::new();
    }

    /**
     * Scope municipality
     *
     * @param Builder $query
     * @param array|string|null $municipalityCode
     * @return Builder
     */
    public function scopeMunicipality(Builder $query, array|string|null $municipalityCode = []): Builder
    {
        if (empty($municipalityCode)) {
            return $query;
        }

        $municipalityCode = (array) $municipalityCode;

        return $query->whereIn('municipality_code', $municipalityCode);
    }

    /**
     * Full
     *
     * @return Attribute
     */
    public function full(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name
                . ', '
                . $this->municipality_name
                . ', '
                . $this->province_name
                . ', '
                . $this->region_name
        );
    }
}
