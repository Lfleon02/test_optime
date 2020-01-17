<?php

namespace App\Repository;

use App\Entity\Productos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Productos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productos[]    findAll()
 * @method Productos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productos::class);
    }

    public function SearchProducts(){

        return $this->getEntityManager()
        ->createQuery('
            SELECT prod.codigo, prod.nombre, prod.descripcion, prod.marca, prod.categoria, prod.precio 
            FROM App\Entity\Productos as prod
            JOIN App\Entity\Categorias as cate
            WHERE prod.categoria = cate.nombre
            AND cate.activo = 1
            '); 

    }
    // /**
    //  * @return Productos[] Returns an array of Productos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
