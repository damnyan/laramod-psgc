<?php

namespace Modules\PSGC\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PSGC\Models\Traits\NameQueryable;
use Modules\PSGC\Database\Factories\RegionFactory;

class Region extends Model
{
    use HasFactory;
    use NameQueryable;

    protected $table = 'psgc_regions';

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * Factory
     *
     * @return RegionFactory
     */
    protected static function newFactory(): RegionFactory
    {
        return RegionFactory::new();
    }
}
