<?php

namespace Modular\Modular\Traits;

trait UpdateOrder
{
    /**
     * Add reorder functionality for the Model.
     */
    public function updateOrder(array $items): void
    {
        foreach ($items as $index => $item) {
            $this->where('id', $item['id'])
                ->update(['order' => $index]);
        }
    }
}
