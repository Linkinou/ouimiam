<?php

namespace FrontBundle\Model;

use AppBundle\Entity\Ingredient;

class ShoppingListIngredient
{
    /** @var string */
    private $name;

    /** @var string */
    private $unit;

    /** @var int */
    private $quantity;

    /**
     * ShoppingListIngredient constructor.
     * @param string $name
     * @param string $unit
     * @param int $quantity
     */
    public function __construct(string $name, string $unit, int $quantity)
    {
        $this->name = $name;
        $this->unit = $unit;
        $this->quantity = $quantity;
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
     * @return ShoppingListIngredient
     */
    public function setName(string $name): ShoppingListIngredient
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ShoppingListIngredient
     */
    public function setQuantity(int $quantity): ShoppingListIngredient
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return ShoppingListIngredient
     */
    public function setUnit(string $unit): ShoppingListIngredient
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @param Ingredient $ingredient
     */
    public function cumulateIngredient(Ingredient $ingredient)
    {
        if ($ingredient->getBaseIngredient()->getName() === $this->name) {
            $this->quantity += (int) $ingredient->getAmount();
        }
    }
}