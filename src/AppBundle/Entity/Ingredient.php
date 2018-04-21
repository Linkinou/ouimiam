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
class Ingredient
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $quantity;

    /**
     * @var ArrayCollection|Recipe[]
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Recipe", inversedBy="ingredients")
     */
    private $recipes;

    /**
     * Ingredient constructor.
     */
    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Ingredient
     */
    public function setId(int $id): Ingredient
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     * @return Ingredient
     */
    public function setQuantity(string $quantity): Ingredient
    {
        $this->quantity = $quantity;

        return $this;
    }


    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Ingredient
     */
    public function setName(string $name): Ingredient
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Ingredient
     */
    public function setNote(string $note): Ingredient
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Recipe[]|Collection
     */
    public function getRecipes() : Collection
    {
        return $this->recipes;
    }

    /**
     * @param Recipe[]|ArrayCollection $recipes
     * @return Ingredient
     */
    public function setRecipes(array $recipes)
    {
        $this->recipes = $recipes;

        return $this;
    }

    /**
     * @param Recipe $recipe
     * @return Ingredient
     */
    public function addRecipe(Recipe $recipe) : Ingredient
    {
        $this->recipes->add($recipe);

        return $this;
    }

    /**
     * @param Recipe $recipe
     * @return Ingredient
     */
    public function removeRecipe(Recipe $recipe) : Ingredient
    {
        $this->recipes->removeElement($recipe);

        return $this;
    }
}
