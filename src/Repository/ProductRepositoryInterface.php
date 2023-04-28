<?php

namespace App\Repository;

use App\Entity\Product;

interface ProductRepositoryInterface
{
    public function findAllOrderedByName(): array;
    public function save(Product $product): void;
    public function remove(Product $product): void;
    public function findByPriceRange(float $minPrice, float $maxPrice): array;
}