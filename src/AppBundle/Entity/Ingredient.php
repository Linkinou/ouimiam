<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

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
     * @var IngredientModel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\IngredientModel")
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $quantity;

    /**
     * @var Unit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit")
     */
    private $unit;

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
     * @return IngredientModel
     */
    public function getModel(): IngredientModel
    {
        return $this->model;
    }

    /**
     * @param IngredientModel $model
     * @return Ingredient
     */
    public function setModel(IngredientModel $model): Ingredient
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
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
     * @return Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * @param Unit $unit
     * @return Ingredient
     */
    public function setUnit(Unit $unit): Ingredient
    {
        $this->unit = $unit;

        return $this;
    }
}
