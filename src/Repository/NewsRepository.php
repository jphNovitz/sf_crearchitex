<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }


    /**
     * @return News[] Returns an array of News objects
     */
    public function findAllNews(){
        return $this->createQueryBuilder('n')
            ->addSelect('n')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return News Returns a News object
     */
    public function findNews($id){
        return $this->createQueryBuilder('n')
            ->addSelect('n')
            ->andWhere('id == :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return News[] Returns an array of x last News objects
     * return only id and title
     */
    public function findLastNews($max = null){
        return $this->createQueryBuilder('n')
            ->addSelect('n.id, n.title')
            ->orderBy('n.id', 'DESC')
            ->setMaxResults($max)
            ->getQuery()
            ->getResult();
    }

}
