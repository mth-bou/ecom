<?php

namespace App\Repository;

use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductCategory>
 *
 * @method ProductCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCategory[]    findAll()
 * @method ProductCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductCategoryRepository extends ServiceEntityRepository implements ProductCategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCategory::class);
    }

    public function save(ProductCategory $productCategory): void
    {
        $this->getEntityManager()->persist($productCategory);
        $this->getEntityManager()->flush();
    }

    public function remove(ProductCategory $productCategory): void
    {
        $this->getEntityManager()->remove($productCategory);
        $this->getEntityManager()->flush();
    }

    public function edit(ProductCategory $productCategory, ?array $fields): void
    {
        foreach ($fields as $fieldName => $fieldValue) {
            $setter = 'set' . ucfirst($fieldName);
            if (method_exists($productCategory, $setter)) {
                $productCategory->$setter($fieldValue);
            }
        }
        $this->save($productCategory);
    }

    public function findByName(string $name): ?ProductCategory
    {
        return $this->createQueryBuilder('pc')
            ->where('pc.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findById(int $id): ?ProductCategory
    {
        return $this->createQueryBuilder('pc')
            ->where('pc.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }


}
