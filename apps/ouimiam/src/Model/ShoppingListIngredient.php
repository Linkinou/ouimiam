<?php

namespace App\Model;

use App\Entity\BaseIngredient;

class ShoppingListIngredient
{
    /** @var string */
    private $name;

    /** @var int */
    private $quantity;

    /**
     * ShoppingListIngredient constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->quantity = 1;
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
     * @param BaseIngredient $ingredient
     */
    public function cumulateIngredient()
    {
        $this->quantity++;
    }
}