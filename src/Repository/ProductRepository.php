<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findNewest()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.uploaded', 'DESC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

    public function findBest($offset)
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.sold', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
