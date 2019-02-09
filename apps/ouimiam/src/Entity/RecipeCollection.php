<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @var HungryUser
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\HungryUser")
     */
    private $user;

    /**
     * @var ArrayCollection|Recipe[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="collections")
     */
    private $recipes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

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
    public function getName(): ?string
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
     * @return HungryUser
     */
    public function getUser(): ?HungryUser
    {
        return $this->user;
    }

    /**
     * @param HungryUser $user
     * @return RecipeCollection
     */
    public function setUser(HungryUser $user): RecipeCollection
    {
        $this->user = $user;

        return $this;
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
        $recipe->addCollection($this);
        $this->recipes->add($recipe);

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
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return RecipeCollection
     */
    public function setDescription(string $description): RecipeCollection
    {
        $this->description = $description;
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

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf('%s', $this->getName());
    }
}