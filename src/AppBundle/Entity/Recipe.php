<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\HungryUser")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $preparation;

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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $duration;

    /**
     * @var Difficulty
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Difficulty")
     */
    private $difficulty;

    /**
     * @var ArrayCollection|Ingredient[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ingredient", mappedBy="recipes", cascade={"persist"})
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\RecipeCollection", inversedBy="recipes")
     */
    private $collections;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="recipe_image", fileNameProperty="imageName")
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
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->collections = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->image = new EmbeddedFile();
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
    public function getUser(): HungryUser
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
     * @param Ingredient[]|ArrayCollection $ingredients
     * @return Recipe
     */
    public function setIngredients(array $ingredients) : Recipe
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * @param Ingredient $ingredient
     * @return $this
     */
    public function addIngredient(Ingredient $ingredient) : Recipe
    {
        $ingredient->addRecipe($this);

        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
        }

        return $this;
    }

    /**
     * @param Ingredient $ingredient
     * @return $this
     */
    public function removeIngredient(Ingredient $ingredient) : Recipe
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
    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    /**
     * @param string $preparation
     * @return Recipe
     */
    public function setPreparation(string $preparation): Recipe
    {
        $this->preparation = $preparation;

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
     * @return string
     */
    public function getDuration(): ?string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return Recipe
     */
    public function setDuration(string $duration): Recipe
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Difficulty
     */
    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    /**
     * @param Difficulty $difficulty
     * @return Recipe
     */
    public function setDifficulty(Difficulty $difficulty): Recipe
    {
        $this->difficulty = $difficulty;

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
     * @return Recipe
     */
    public function setImage(EmbeddedFile $image): Recipe
    {
        $this->image = $image;

        return $this;
    }
}
