<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class HungryUser implements UserInterface, EquatableInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var UserAvatar
     *
     * @ORM\OneToOne(targetEntity="App\Entity\UserAvatar", inversedBy="hungryUser", cascade={"persist"})
     */
    private $avatar;

    /**
     * HungryUser constructor.
     */
    public function __construct()
    {
        $this->avatar = new UserAvatar();
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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @return string
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param int $id
     * @return HungryUser
     */
    public function setId(int $id): HungryUser
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $username
     * @return HungryUser
     */
    public function setUsername(string $username): HungryUser
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $email
     * @return HungryUser
     */
    public function setEmail(string $email): HungryUser
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return HungryUser
     */
    public function setPassword(string $password): HungryUser
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $plainPassword
     * @return HungryUser
     */
    public function setPlainPassword(string $plainPassword): HungryUser
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @param array $roles
     * @return HungryUser
     */
    public function setRoles(array $roles): HungryUser
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof HungryUser) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf('%s', $this->getEmail());
    }

    /**
     * @return UserAvatar
     */
    public function getAvatar(): ?UserAvatar
    {
        return $this->avatar;
    }

    /**
     * @param UserAvatar $avatar
     * @return HungryUser
     */
    public function setAvatar(UserAvatar $avatar): HungryUser
    {
        $this->avatar = $avatar;
        return $this;
    }
}