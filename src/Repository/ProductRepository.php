<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }

    public function remove(Product $product): void
    {
        $this->getEntityManager()->remove($product);
        $this->getEntityManager()->flush();
    }

    public function edit(Product $product, array $fields): void
    {
        foreach ($fields as $field => $value) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($product, $setter)) {
                $product->$setter($value);
            }
        }

        $this->save($product);
    }

    public function findAllOrderedByName(): array
    {
        return $this->createQueryBuilder('p')
            ->addOrderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByPriceRange(float $minPrice, float $maxPrice): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.price >= :minPrice')
            ->andWhere('p.price <= :maxPrice')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('maxPrice', $maxPrice)
            ->getQuery()
            ->getResult();
    }

    public function findByName(string $name): ?Product
    {
        return $this->createQueryBuilder('p')
            ->where('p.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByCategory(ProductCategory $category): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    public function findByIdAndCategory(int $id, ProductCategory $category): ?Product
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->andWhere('p.category = :category')
            ->setParameter('id', $id)
            ->setParameter('category', $category)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
