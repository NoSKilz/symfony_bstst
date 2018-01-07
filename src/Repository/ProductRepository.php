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

    public function findNewest($offset)
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.uploaded', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

    public function findBest()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.sold', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
    public function findByPlatformGenre($platform, $genre)
    {
        $qb = $this->createQueryBuilder('p');
        return $qb->select('p.product_id, p.product_name, p.platform_name, p.price')
                  ->where($qb->expr()->andX(
                      $qb->expr()->eq('p.platform_name', '?1'),
                      $qb->expr()->eq('p.genre_name', '?2')
                  ))
                  ->orderBy('p.product_name','DESC')
                  ->setParameters([1 => $platform , 2 => $genre])
                  ->getQuery()
                  ->getResult();
    }
    public function findSearch($query)
    {
        $qb = $this->createQueryBuilder('p');
        return $qb->select('p.product_id, p.product_name, p.platform_name, p.price')
                  ->where($qb->expr()->like('p.product_name','?1'))
                  ->orderBy('p.product_name','DESC')
                  ->setParameters([1 => '%' . $query . '%'])
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
