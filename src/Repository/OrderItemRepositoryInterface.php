<?php

namespace App\Repository;

use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\User;

interface OrderItemRepositoryInterface
{
    public function save(OrderItem $orderItem): void;
    public function remove(OrderItem $orderItem): void;
    public function edit(OrderItem $orderItem, ?array $fields): void;
    public function findByUser(User $user): array;
    public function findByProduct(Product $product): array;
    public function findByIdAndUser(int $id, User $user): ?OrderItem;
}