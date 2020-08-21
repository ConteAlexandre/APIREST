<?php
/*
 * Created at 8/19/20, 1:22 AM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Repository;


use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class UsersRepository
 * @package App\Repository
 */
class UsersRepository extends ServiceEntityRepository
{
    /**
     * UsersRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }
}