<?php

namespace App\Repository;

use App\Entity\ProductCategory;

interface ProductCategoryRepositoryInterface
{
    public function save(ProductCategory $productCategory): void;
    public function remove(ProductCategory $productCategory): void;
    public function edit(ProductCategory $productCategory, array $fields): void;
    public function findByName(string $name): ?ProductCategory;
    public function findById(int $id): ?ProductCategory;
}