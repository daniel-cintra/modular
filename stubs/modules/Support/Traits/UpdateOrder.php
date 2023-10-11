<?php

namespace Modules\Support\Traits;

trait UpdateOrder
{
    /**
     * Add reorder functionality for the Model.
     */
    public function updateOrder(array $items): void
    {
        foreach ($items as $index => $item) {
            if (is_array($item)) {
                $this->where('id', $item['id'])
                    ->update(['order' => $index]);
            }
        }
    }
}
