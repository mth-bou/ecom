<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\CartItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CartItem>
 *
 * @method CartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartItem[]    findAll()
 * @method CartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartItemRepository extends ServiceEntityRepository implements CartItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function save(CartItem $cartItem): void
    {
        $this->getEntityManager()->persist($cartItem);
        $this->getEntityManager()->flush();
    }

    public function remove(CartItem $cartItem): void
    {
        $this->getEntityManager()->remove($cartItem);
        $this->getEntityManager()->flush();
    }

    public function edit(CartItem $cartItem, ?array $fields): void
    {
        foreach ($fields as $field => $value) {
            $method = sprintf('set%s', ucfirst($field));
            if (method_exists($cartItem, $method)) {
                $cartItem->$method($value);
            }
        }
        $this->save($cartItem);
    }

    public function findByCart(Cart $cart): array
    {
        return $this->createQueryBuilder('ci')
            ->where('ci.cart = :cart')
            ->setParameter('cart', $cart)
            ->getQuery()
            ->getResult();
    }

    public function findByIdAndCart(int $id, Cart $cart): ?CartItem
    {
        return $this->createQueryBuilder('ci')
            ->where('ci.id = :id')
            ->andWhere('ci.cart = :cart')
            ->setParameter('id', $id)
            ->setParameter('cart', $cart)
            ->getQuery()
            ->getOneOrNullResult();
    }


}
