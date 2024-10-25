<?php

namespace Modules\Support\Traits;

trait UpdateOrder
{
    protected function getOrderFieldName(): string
    {
        return 'order';
    }

    public function updateOrder(array $items): void
    {
        foreach ($items as $index => $item) {
            if (is_array($item)) {
                $this->where('id', $item['id'])
                    ->update([$this->getOrderFieldName() => $index]);
            }
        }
    }
}
