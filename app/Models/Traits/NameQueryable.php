<?php

namespace Modules\PSGC\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait NameQueryable
{
    /**
     * Scope name
     *
     * @param Builder $query
     * @param string|null $q
     *
     * @return Builder
     */
    public function scopeName(Builder $query, ?string $q = null): Builder
    {
        if (is_null($q) == true) {
            return $query;
        }

        return $query->where('name', 'like', '%' . $q . '%');
    }
}
