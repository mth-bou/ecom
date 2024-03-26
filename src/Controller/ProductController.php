<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    #[Route("/products", name:"product_index", methods: ["GET"])]
    public function index(): Response
    {
        $products = $this->productService->getAllProducts();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route("/products/new", name: "product_new", methods: ["GET", "POST"])]
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productService->createProduct($product);
            $this->addFlash('success', 'Produit créé avec succès');

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/products/{id}/edit", name: "product_edit", methods: ["GET", "POST"])]
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(Product::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productService->updateProduct($product);
            $this->addFlash('success', 'Produit mis à jour avec succès');

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/products/{id}", name: "product_show", methods: ["GET"])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    #[Route("/products/{id}", name: "product_delete", methods: ["DELETE"])]
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $this->productService->deleteProduct($product);
            $this->addFlash('success', 'Produit supprimé avec succès');
        }

        return $this->redirectToRoute('product_index');
    }
}
