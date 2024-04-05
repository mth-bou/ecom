<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\User;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;
    public function remove(Order $order): void;
    public function findByUser(User $user): array;
    public function findByIdAndUser(int $id, User $user): ?Order;
}