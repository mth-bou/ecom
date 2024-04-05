<?php

namespace App\Repository;

use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderItem>
 *
 * @method OrderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItem[]    findAll()
 * @method OrderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemRepository extends ServiceEntityRepository implements OrderItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
    }

    public function save(OrderItem $orderItem, bool $flush = false): void
    {
        $this->getEntityManager()->persist($orderItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function edit(OrderItem $orderItem, ?array $fields, bool $flush = false): void
    {
        foreach ($fields as $fieldName => $fieldValue) {
            $setter = 'set' . ucfirst($fieldName);
            if (method_exists($orderItem, $setter)) {
                $orderItem->$setter($fieldValue);
            }
        }
        $this->getEntityManager()->persist($orderItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrderItem $orderItem, bool $flush = false): void
    {
        $this->getEntityManager()->remove($orderItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('oi')
            ->where('oi.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    public function findByProduct(Product $product): array
    {
        return $this->createQueryBuilder('oi')
            ->where('oi.product = :product')
            ->setParameter('product', $product)
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByIdAndUser(int $id, int $userId): ?OrderItem
    {
        return $this->createQueryBuilder('oi')
            ->where('oi.id = :id')
            ->andWhere('oi.user_id = :userId')
            ->setParameter('id', $id)
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return OrderItem[] Returns an array of OrderItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderItem
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
