<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\User;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;
    public function remove(Order $order): void;
    public function findByUser(int $userId): array;
    public function findByIdAndUserId(int $id, int $userId): array;
}