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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    protected $passwordEncoder;

    /**
     * UserManager constructor.
     *
     * @param EntityManagerInterface $manager
     * @param UsersRepository $usersRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(EntityManagerInterface $manager, UsersRepository $usersRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $manager;
        $this->userrepository = $usersRepository;
        $this->passwordEncoder = $passwordEncoder;
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
     * @param Users $user
     *
     * @throws \Exception
     */
    public function updatePassword(Users $user): void
    {
        dump($user->getPlainPassword());
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $user->setSalt(rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '='));
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPlainPassword()));
            $user->eraseCredentials();
        }
    }

    /**
     * Save User
     *
     * @param Users $users
     * @param bool $andFlush
     *
     * @throws \Exception
     */
    public function save(Users $users, $andFlush = true): void
    {
        $this->updatePassword($users);

        $this->em->persist($users);
        if ($andFlush) {
            $this->em->flush();
        }
    }
}