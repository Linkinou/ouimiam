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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ingredient")
     *
     */
    private $ingredients;

    /**
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
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
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
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
    public function setIngredients(array $ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
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
    public function getPreparation(): string
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
    public function getCookingSteps(): string
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
    public function getDuration(): string
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
    public function getDifficulty(): Difficulty
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
}
