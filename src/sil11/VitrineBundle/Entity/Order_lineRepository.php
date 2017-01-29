<?php
namespace sil11\VitrineBundle\Entity;
use Doctrine\ORM\EntityRepository;

class Order_lineRepository extends EntityRepository
{
    public function findPlusVendus() {
          
          $qb = $this->getEntityManager()->createQueryBuilder();
         $qb->select( 'o, SUM(o.order_quantity) as qte')
             ->from('sil11VitrineBundle:Order_line', 'o')
            ->groupBy ('o.product')
           ->orderBy('qte', 'DESC')
            ->setMaxResults(3);
               
          return $qb->getQuery()->getResult();
    }
}
