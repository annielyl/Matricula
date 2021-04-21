<?php

namespace App\Repository;

use App\Entity\Disciplina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DisciplinaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disciplina::class);
    }

    public function save(Disciplina $disciplina){
        $em=$this->getEntityManager();
        $em->beginTransaction();
        $em->persist($disciplina);
        $em->commit();
        $em->flush();
    }

    public function remove(Disciplina $disciplina){

        $em=$this->getEntityManager();
        $em->beginTransaction();
        $em->remove($disciplina);
        $em->commit();
        $em->flush();
        
    }
}