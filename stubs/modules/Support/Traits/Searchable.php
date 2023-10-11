<?php

namespace Modules\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Add search functionality for the Model.
     */
    public function scopeSearch(Builder $query, ?string $searchColumn, ?string $searchTerm)
    {
        $searchTerm = preg_replace('/[^A-Za-z0-9 ]/', '', $searchTerm);

        $query->when($searchTerm, function ($query, $searchTerm) use ($searchColumn) {
            $query->where($searchColumn, 'like', "%{$searchTerm}%");
        });
    }
}
