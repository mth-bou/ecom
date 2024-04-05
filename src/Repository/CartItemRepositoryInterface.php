<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\CartItem;

interface CartItemRepositoryInterface
{
    public function save(CartItem $cartItem): void;
    public function remove(CartItem $cartItem): void;
    public function edit(CartItem $cartItem, ?array $fields): void;
    public function findByCart(Cart $cart): array;
    public function findByIdAndCart(int $id, Cart $cart): ?CartItem;
}