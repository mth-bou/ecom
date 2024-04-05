<?php

namespace App\Service;

use App\Entity\OrderItem;
use App\Entity\User;
use App\Entity\User2;
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

    public function updateOrderItem(OrderItem $orderItem): void
    {
        $this->orderItemRepository->save($orderItem);
    }

    public function deleteOrderItem(OrderItem $orderItem): void
    {
        $this->orderItemRepository->remove($orderItem);
    }

    public function getByUser(int $userId): array
    {
        return $this->orderItemRepository->find($userId);
    }

    public function getByProduct(int $productId): array
    {
        return $this->orderItemRepository->find($productId);
    }

    public function getByIdAndUser(int $id, User $user): ?OrderItem
    {
        return $this->orderItemRepository->findByIdAndUser($id, $user);
    }

}