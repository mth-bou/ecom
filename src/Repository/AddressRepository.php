<?php

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Address>
 *
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressRepository extends ServiceEntityRepository implements AddressRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function save(Address $address, bool $flush = false): void
    {
        $this->getEntityManager()->persist($address);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function edit(Address $address, array $fields, bool $flush = false): void
    {
        foreach ($fields as $fieldName => $fieldValue) {
            $setter = 'set' . ucfirst($fieldName);
            if (method_exists($address, $setter)) {
                $address->$setter($fieldValue);
            }
        }
        $this->getEntityManager()->persist($address);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Address $address, bool $flush = false): void
    {
        $this->getEntityManager()->remove($address);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findById(int $id): ?Address
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findByIdAndUserId(int $id, int $userId): ?Address
    {
        return $this->findOneBy(['id' => $id, 'user_id' => $userId]);
    }

//    /**
//     * @return Address[] Returns an array of Address objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Address
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
