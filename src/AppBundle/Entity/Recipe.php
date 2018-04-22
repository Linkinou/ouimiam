<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity
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
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->createdAt = new \DateTime();
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
}
