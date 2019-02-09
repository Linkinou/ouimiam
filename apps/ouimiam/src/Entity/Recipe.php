<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Recipe
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
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var HungryUser
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\HungryUser")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $cookingSteps;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var ArrayCollection|BaseIngredient[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\BaseIngredient", inversedBy="recipes")
     * @ORM\JoinTable(name="recipes_ingredients")
     *
     */
    private $ingredients;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var ArrayCollection|RecipeCollection[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\RecipeCollection", inversedBy="recipes")
     */
    private $collections;

    /**
     * @Assert\File(
     *     maxSize="500k",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     *
     * @Vich\UploadableField(mapping="recipe_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->collections = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name) : Recipe
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return HungryUser
     */
    public function getUser(): ?HungryUser
    {
        return $this->user;
    }

    /**
     * @param HungryUser $user
     * @return Recipe
     */
    public function setUser(HungryUser $user): Recipe
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getIngredients() : Collection
    {
        return $this->ingredients;
    }

    /**
     * @param BaseIngredient[]|ArrayCollection $ingredients
     * @return Recipe
     */
    public function setIngredients(array $ingredients) : Recipe
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * @param BaseIngredient $ingredient
     * @return $this
     */
    public function addIngredient(BaseIngredient $ingredient) : Recipe
    {
        $ingredient->addRecipe($this);
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * @param BaseIngredient $ingredient
     * @return $this
     */
    public function removeIngredient(BaseIngredient $ingredient) : Recipe
    {
        $this->ingredients->remove($ingredient);

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Recipe
     */
    public function setDescription(string $description): Recipe
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getCookingSteps(): ?string
    {
        return $this->cookingSteps;
    }

    /**
     * @param string $cookingSteps
     * @return Recipe
     */
    public function setCookingSteps(string $cookingSteps): Recipe
    {
        $this->cookingSteps = $cookingSteps;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return RecipeCollection[]|ArrayCollection
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @param RecipeCollection[]|ArrayCollection $collections
     * @return Recipe
     */
    public function setCollections($collections)
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * @param RecipeCollection $collection
     * @return $this
     */
    public function addCollection(RecipeCollection $collection)
    {
        $this->collections->add($collection);

        return $this;
    }

    /**
     * @param RecipeCollection $collection
     * @return $this
     */
    public function removeCollection(RecipeCollection $collection)
    {
        $this->collections->removeElement($collection);

        return $this;
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
            $this->updatedAt = new \DateTime();
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
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Recipe
     */
    public function setImage(string $image): Recipe
    {
        $this->image = $image;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
