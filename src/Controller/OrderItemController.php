<?php

namespace App\Controller;

use App\Entity\OrderItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderItemController extends AbstractController
{
    #[Route('/order-items', name: 'order_item_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $orderItems = $entityManager->getRepository(OrderItem::class)->findAll();

        return $this->render('order_item/index.html.twig', [
            'order_items' => $orderItems,
        ]);
    }

    #[Route('/order-items/new', name: 'order_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orderItem = new OrderItem();
        $form = $this->createForm(OrderItem::class, $orderItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orderItem);
            $entityManager->flush();

            return $this->redirectToRoute('order_item_index');
        }

        return $this->render('order_item/new.html.twig', [
            'order_item' => $orderItem,
            'form'       => $form->createView()
        ]);
    }

    #[Route('/order-items/{id}', name: 'order_item_show', methods: ['GET'])]
    public function show(OrderItem $orderItem): Response
    {
        return $this->render('order_item/show.html.twig', [
            'order_item' => $orderItem
        ]);
    }

    #[Route('/order-items/{id}/edit', name: 'order_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrderItem $orderItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderItem::class, $orderItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('order_item_index');
        }

        return $this->render('order_item/edit.html.twig', [
            'order_item' => $orderItem,
            'form' => $form->createView()
        ]);
    }

    #[Route("/order-items/{id}", name: "order_items_delete", methods: ["DELETE"])]
    public function delete(Request $request, OrderItem $orderItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($orderItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_item_index');
    }
}
