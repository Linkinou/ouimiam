<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BaseIngredient
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
     */
    private $name;

    /**
     * @var ArrayCollection|Recipe[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="ingredients")
     */
    private $recipes;

    /**
     * BaseIngredient constructor.
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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BaseIngredient
     */
    public function setName(string $name): BaseIngredient
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param Recipe $recipe
     */
    public function addRecipe(Recipe $recipe)
    {
        $this->recipes->add($recipe);
    }

    /**
     * @param Recipe $recipe
     */
    public function removeRecipe(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }

    /**
     * @return Recipe[]|ArrayCollection
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * @param Recipe[]|ArrayCollection $recipes
     * @return BaseIngredient
     */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf('%s', $this->getName());
    }
}