<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->findAll();
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(Product $product): void
    {
        $this->productRepository->save($product);
    }

    public function updateProduct(Product $product): void
    {
        $this->productRepository->save($product);
    }

    public function deleteProduct(Product $product): void
    {
        $this->productRepository->remove($product);
    }
}