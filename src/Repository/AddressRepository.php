<?php

namespace App\Repository;

use App\Entity\Address;
use App\Entity\User;
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

    public function save(Address $address): void
    {
        $this->getEntityManager()->persist($address);
        $this->getEntityManager()->flush();
    }

    public function edit(Address $address, ?array $fields): void
    {
        foreach ($fields as $fieldName => $fieldValue) {
            $setter = 'set' . ucfirst($fieldName);
            if (method_exists($address, $setter)) {
                $address->$setter($fieldValue);
            }
        }
        $this->save($address);
    }

    public function remove(Address $address): void
    {
        $this->getEntityManager()->remove($address);
        $this->getEntityManager()->flush();
    }

    public function findByIdAndUser(int $id, User $user): ?Address
    {
        return $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->andWhere('a.user = :user')
            ->setParameter('id', $id)
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
