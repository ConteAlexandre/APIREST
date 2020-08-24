<?php
/*
 * Created at 8/21/20, 4:02 PM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\EntityManager;


use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserManager
 * @package App\EntityManager
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class UserManager
{
    protected $em;
    protected $userrepository;

    /**
     * UserManager constructor.
     *
     * @param EntityManagerInterface $manager
     * @param UsersRepository $usersRepository
     */
    public function __construct(EntityManagerInterface $manager, UsersRepository $usersRepository)
    {
        $this->em = $manager;
        $this->userrepository = $usersRepository;
    }

    /**
     * Create User
     *
     * @return Users
     */
    public function create(): object
    {
        return new Users();
    }

    /**
     * Save User
     *
     * @param Users $users
     * @param bool $andFlush
     */
    public function save(Users $users, $andFlush = true): void
    {
        $this->em->persist($users);

        if ($andFlush) {
            $this->em->flush();
        }
    }
}