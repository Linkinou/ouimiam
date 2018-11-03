<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @Vich\Uploadable()
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
     * @Assert\NotBlank()
     */
    private $plainPassword;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @Assert\File(
     *     maxSize="500k",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     *
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * HungryUser constructor.
     */
    public function __construct()
    {
        $this->image = new EmbeddedFile();
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $image
     */
    public function setImageFile(?File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @return EmbeddedFile
     */
    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }

    /**
     * @param EmbeddedFile $image
     * @return HungryUser
     */
    public function setImage(EmbeddedFile $image): HungryUser
    {
        $this->image = $image;

        return $this;
    }

}