<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\User;
use App\Repository\CartRepositoryInterface;

class CartService
{
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function createCart(Cart $cart): void
    {
        $this->cartRepository->save($cart);
    }

    public function updateCart(Cart $cart, ?array $fields): void
    {
        $this->cartRepository->edit($cart, $fields);
    }

    public function deleteCart(Cart $cart): void
    {
        $this->cartRepository->remove($cart);
    }

    public function getAllCarts(): array
    {
        return $this->cartRepository->findAll();
    }

    public function getCartById(int $id): ?Cart
    {
        return $this->cartRepository->find($id);
    }

    public function getCartsByUser(User $user): array
    {
        return $this->cartRepository->findByUser($user);
    }

    public function getCartsByStatus(string $status): array
    {
        return $this->cartRepository->findByStatus($status);
    }

    public function getCartByIdAndUser(int $id, User $user): ?Cart
    {
        return $this->cartRepository->findByIdAndUser($id, $user);
    }
}