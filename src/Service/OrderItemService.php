<?php

namespace App\Service;

use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\OrderItemRepositoryInterface;

class OrderItemService
{
    private OrderItemRepositoryInterface $orderItemRepository;

    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllOrderItems(): array
    {
        return $this->orderItemRepository->findAll();
    }

    public function getOrderItemById(int $id): ?OrderItem
    {
        return $this->orderItemRepository->find($id);
    }

    public function createOrderItem(OrderItem $orderItem): void
    {
        $this->orderItemRepository->save($orderItem);
    }

    public function updateOrderItem(OrderItem $orderItem, ?array $fields): void
    {
        $this->orderItemRepository->edit($orderItem, $fields);
    }

    public function deleteOrderItem(OrderItem $orderItem): void
    {
        $this->orderItemRepository->remove($orderItem);
    }

    public function getOrderItemsByUser(User $user): array
    {
        return $this->orderItemRepository->findByUser($user);
    }

    public function getOrderItemsByProduct(Product $product): array
    {
        return $this->orderItemRepository->findByProduct($product);
    }

    public function getOrderItemByIdAndUser(int $id, User $user): ?OrderItem
    {
        return $this->orderItemRepository->findByIdAndUser($id, $user);
    }

}