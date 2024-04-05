<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\User;

interface CartRepositoryInterface
{
    public function save(Cart $cart): void;
    public function remove(Cart $cart): void;
    public function edit(Cart $cart, ?array $fields): void;
    public function findByUser(User $user): array;
    public function findByStatus(string $status): array;
    public function findByIdAndUser(int $id, User $user): ?Cart;
}