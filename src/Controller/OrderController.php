<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    #[Route("/orders", name: "order_index", methods: ["GET"])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $orders = $entityManager->getRepository(Order::class)->findAll();

        return $this->render('order/index.html.twig', [
            'orders' => $orders
        ]);
    }

     #[Route("/orders/new", name: "order_new", methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $order = new Order();
        $form = $this->createForm(Order::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form->createView
        ]);
    }

    #[Route("/orders/{id}", name: "order_edit", requirements: ["id" => "\d"], methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Order $order): Response
    {
        $form = $this->createForm(Order::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView()
        ]);
    }

    #[Route("/orders/{id}", name: "order_show", requirements: ["id"], methods: ["GET"])]
    public function show(Request $request, Order $order): Response
    {
        return $this->render('order/show.html.twig', ['order' => $order]);
    }

    #[Route("/orders/{id}", name: "order_delete", requirements: ["id"], methods: ["DELETE"])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index');
    }
}
