<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Repository\CartItemRepositoryInterface;

class CartItemService
{
    private CartItemRepositoryInterface $cartItemRepository;

    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function getAllCartItems(): array
    {
        return $this->cartItemRepository->findAll();
    }

    public function getCartItemById(int $id): ?CartItem
    {
        return $this->cartItemRepository->find($id);
    }

    public function getCartItemsByCart(Cart $cart): array
    {
        return $this->cartItemRepository->findByCart($cart);
    }

    public function getCartItemByIdAndCart(int $id, Cart $cart): ?CartItem
    {
        return $this->cartItemRepository->findByIdAndCart($id, $cart);
    }

    public function createCartItem(CartItem $cartItem): void
    {
        $this->cartItemRepository->save($cartItem);
    }

    public function updateCartItem(CartItem $cartItem, ?array $fields): void
    {
        $this->cartItemRepository->edit($cartItem, $fields);
    }

    public function deleteCartItem(CartItem $cartItem): void
    {
        $this->cartItemRepository->remove($cartItem);
    }
}