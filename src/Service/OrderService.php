<?php

namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderRepositoryInterface;

class OrderService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders(): array
    {
        return $this->orderRepository->findAll();
    }

    public function getOrderById(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    public function createOrder(Order $order): void
    {
        $this->orderRepository->save($order);
    }

    public function updateOrder(Order $order): void
    {
        $this->orderRepository->save($order);
    }

    public function deleteOrder(Order $order): void
    {
        $this->orderRepository->remove($order);
    }
}