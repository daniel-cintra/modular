<?php

namespace Modules\Support\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Add search functionality for the Model.
     */
    public function scopeSearch(Builder $query, ?string $searchColumn, ?string $searchTerm): void
    {
        $searchTerm = trim($searchTerm ?? '');
        if (empty($searchColumn) || empty($searchTerm)) {
            return;
        }

        $searchTerm = preg_replace('/[^A-Za-z0-9 ]/', '', $searchTerm);

        $columns = array_map('trim', explode(',', $searchColumn));

        $query->when($searchTerm, function ($query) use ($columns, $searchTerm) {
            $query->where(function ($query) use ($columns, $searchTerm) {
                foreach ($columns as $index => $column) {
                    // Use where for the first column to start the group, then orWhere for subsequent columns
                    if ($index === 0) {
                        $query->where($column, 'like', "%{$searchTerm}%");
                    } else {
                        $query->orWhere($column, 'like', "%{$searchTerm}%");
                    }
                }
            });
        });
    }
}
