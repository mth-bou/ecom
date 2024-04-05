<?php

namespace App\Service;

use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepositoryInterface;

class ProductCategoryService
{
    private ProductCategoryRepositoryInterface $productCategoryRepository;
    
    public function __construct(ProductCategoryRepositoryInterface $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }
    
    public function createProductCategory(ProductCategory $productCategory): void
    {
        $this->productCategoryRepository->save($productCategory);
    }
    
    public function updateProductCategory(ProductCategory $productCategory, ?array $fields): void
    {
        $this->productCategoryRepository->edit($productCategory, $fields);
    }

    public function deleteProductCategory(ProductCategory $productCategory): void
    {
        $this->productCategoryRepository->remove($productCategory);
    }
    
    public function getProductCategories(): array
    {
        return $this->productCategoryRepository->findAll();
    }
    
    public function getProductCategoryById(int $id): ?ProductCategory
    {
        return $this->productCategoryRepository->find($id);
    }
    
    public function getProductCategoryByName(string $name): ?ProductCategory
    {
        return $this->productCategoryRepository->findByName($name);
    }
}