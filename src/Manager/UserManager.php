<?php
/*
 * Created at 8/21/20, 4:02 PM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Manager;


use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;
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
    protected $logger;

    /**
     * UserManager constructor.
     *
     * @param EntityManagerInterface $manager
     * @param UsersRepository $usersRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManagerInterface $manager,
        UsersRepository $usersRepository,
        UserPasswordEncoderInterface $passwordEncoder,
        LoggerInterface $logger)
    {
        $this->em = $manager;
        $this->userrepository = $usersRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->logger = $logger;
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
     * @param string $username
     *
     * @return Users|object|null
     */
    public function getUserByUsername(string $username)
    {
        $user = null;

        try {
            $user = $this->userrepository->findOneBy(['username' => $username]);
        } catch (NonUniqueResultException $exception) {
            $this->logger->error(sprintf('Multiple user returned with the same username: %s', $username));
        } catch (NoResultException $exception) {
        }

        return $user;
    }

    /**
     * Update password user with plainPassword who is the data form
     *
     * @param Users $user
     *
     * @throws \Exception
     */
    public function updatePassword(Users $user): void
    {
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