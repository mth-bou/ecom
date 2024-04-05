<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductCategory;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;
    public function remove(Product $product): void;
    public function edit(Product $product, ?array $fields): void;
    public function findAllOrderedByName(): array;
    public function findByPriceRange(float $minPrice, float $maxPrice): array;
    public function findByName(string $name): array;
    public function findByCategory(ProductCategory $category): array;
    public function findByIdAndCategory(int $id, ProductCategory $category): ?Product;
}