<?php

namespace Core\OrderCancel\Domain\Services;

use Core\OrderCancel\Domain\Entities\OrderCancel;

interface OrderCancelService
{
    public function create(array $data): OrderCancel;
}