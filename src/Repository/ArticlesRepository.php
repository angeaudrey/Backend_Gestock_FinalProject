<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Articles>
 *
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    public function save(Articles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Articles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Articles[] Returns an array of Articles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Articles
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

     public function search($query,$query1,$query3)
    {

       return $q=$this->getEntityManager()
        ->createQueryBuilder()
        ->select('a')
         ->from('App:Articles', 'a')
       
        ->innerJoin('a.categorie','c')
        ->innerJoin('a.user','u')
   
   
      //   ->andWhere('w.id = :id')
  
      
        ->where('a.designation like :query')
        ->andWhere('u.id != :query3')
        ->andWhere('c.id =:query1')
        
      //   ->andWhere('r.prixmoy BETWEEN :prixmoy AND :prixmax')
        
        ->setParameter('query', "%". $query ."%")
        ->setParameter('query3', $query3)
        ->setParameter('query1', $query1)

        
         
      //   ->setParameter('id', $idcat)
  
      //   ->setParameter('prixmoy', "en at")
      //   ->setParameter('prixmax', $prixmaxhotel)
         
      
        ->orderBy('a.id', 'ASC')
        ->getQuery()
        ->getResult();
        
    }


    public function getlistearticlecreer($query3)
    {

       return $q=$this->getEntityManager()
        ->createQueryBuilder()
        ->select('a')
         ->from('App:Articles', 'a')
       
        ->innerJoin('a.categorie','c')
        ->innerJoin('a.user','u')
   
   
      //   ->andWhere('w.id = :id')
  
      
        ->andWhere('u.id = :query3')
         
      //   ->andWhere('r.prixmoy BETWEEN :prixmoy AND :prixmax')
        
         ->setParameter('query3', $query3)
 
        
         
      //   ->setParameter('id', $idcat)
  
      //   ->setParameter('prixmoy', "en at")
      //   ->setParameter('prixmax', $prixmaxhotel)
         
      
        ->orderBy('a.id', 'ASC')
        ->getQuery()
        ->getResult();
        
    }
}
