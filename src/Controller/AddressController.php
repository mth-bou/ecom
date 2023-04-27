<?php

namespace App\Controller;

use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    #[Route('/address', name: 'address_index',  methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $addresses = $entityManager->getRepository(Address::class)->findAll();

        return $this->render('address/index.html.twig', [
            'addresses' => $addresses,
        ]);
    }

    #[Route('/address/new', name: 'address_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $address = new Address();
        $form = $this->createForm(Address::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($address);
            $entityManager->flush();

            return $this->redirectToRoute('address_index');
        }

        return $this->render('address/new.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/address/{id}', name: 'address_show', methods: ['GET'])]
    public function show(Request $request, Address $address): Response
    {
        return $this->render('address/show.html.twig', ['address' => $address]);
    }

    #[Route('/address/{id}', name: 'address_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Address $address): Response
    {
        $form = $this->createForm(Address::class, $address);
        $form->handleRequest($request);

        if ($form->isSubdmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('address_index');
        }

        return $this->render('address/edit.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/address/{id}', name: 'address_delete', methods: ['DELETE'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Address $address): Response
    {
        if ($this->isCsrfTokenValid('delete'.$address->getId(), $request->request->get('_token'))) {
            $entityManager->remove($address);
            $entityManager->flush();
        }

        return $this->redirectToRoute('address_index');
    }
}
