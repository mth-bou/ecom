<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\ProductCategory;
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

    public function updateProduct(Product $product, ?array $fields): void
    {
        $this->productRepository->edit($product, $fields);
    }

    public function deleteProduct(Product $product): void
    {
        $this->productRepository->remove($product);
    }

    public function getProductsOrderedByName(): array
    {
        return $this->productRepository->findAllOrderedByName();
    }

    public function getProductsWithPriceInRange(float $minPrice, float $maxPrice): array
    {
        return $this->productRepository->findByPriceRange($minPrice, $maxPrice);
    }

    public function getProductsByName(string $name): array
    {
        return $this->productRepository->findByName($name);
    }

    public function getProductsByCategory(ProductCategory $category): array
    {
        return $this->productRepository->findByCategory($category);
    }

    public function getProductByIdAndCategory(int $id, ProductCategory $category): ?Product
    {
        return $this->productRepository->findByIdAndCategory($id, $category);
    }
}