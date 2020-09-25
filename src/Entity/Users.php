<?php
/*
 * Created at 8/19/20, 1:19 AM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Users
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class Users implements UserInterface
{
    /**
     * Add the column createdAt and updatedAt
     */
    use TimestampableEntity;

    /**
     * Add the column createdBy and updatedBy
     */
    use BlameableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private int $id;

    /**
     * @var string
     *
     * @Assert\Length(minMessage="2", max="30", minMessage="The firstName must contain 2 characters mini.", maxMessage="The firstName must not contain more than 30 characters.")
     *
     * @Serializer\Groups(groups={"test"})
     *
     * @ORM\Column(name="first_name", type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @Assert\Length(min="5", max="40", minMessage="The lastname must contain 5 characters minimum.", maxMessage="The lastName must not contain more than 40 characters")
     *
     * @ORM\Column(name="last_name", type="string", length=125, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="This field is missing.")
     * @Assert\Length(min="3", max="20", minMessage="The field username must contain 3 characters minimum.", maxMessage="The username must not contain more than 20 characters.")
     *
     * @ORM\Column(name="username", type="string", length=80, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    private $password;

    /**
     * @var string|null
     *
     * @Assert\Length(min="8", minMessage="The password must contain 8 characters minimum")
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string")
     */
    protected string $salt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json", nullable=false)
     */
    private array $roles;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_enabled", type="boolean", nullable=false)
     */
    private bool $isEnabled;

    public function __construct()
    {
        $this->isEnabled = true;
        $this->roles = [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * @return string|void|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt): void
    {
        $this->salt = $salt;
    }

    /**
     * Erase Credentials
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}