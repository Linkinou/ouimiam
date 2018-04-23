<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity
 */
class RecipeCollection
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Recipe", mappedBy="collections")
     */
    private $recipes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * RecipeCollection constructor.
     */
    public function __construct()
    {
        $this->recipes = new ArrayCollection();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): RecipeCollection
    {
        $this->name = $name;

        return $this;
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
     * @return RecipeCollection
     */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;

        return $this;
    }

    /**
     * @param Recipe $recipe
     * @return $this
     */
    public function addRecipe(Recipe $recipe)
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->addCollection($this);
        }

        return $this;
    }

    /**
     * @param Recipe $recipe
     * @return $this
     */
    public function removeRecipe(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);

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
     * @param \DateTime $createdAt
     * @return RecipeCollection
     */
    public function setCreatedAt(\DateTime $createdAt): RecipeCollection
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}