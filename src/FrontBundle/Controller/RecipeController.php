<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController
{
    /**
     * @param Request $request
     *
     * @Route("/recipe/submit", name="submit_recipe")
     */
    public function submitRecipe(Request $request)
    {

    }

    /**
     * @param Recipe $recipe
     *
     * @Route("/recipe/{id}", name="view_recipe")
     *
     * @Template("@Front/recipe/index,html.twig")
     * @return array
     */
    public function viewRecipeAction(Recipe $recipe)
    {
        return [
            'recipe' => $recipe,
        ];
    }
}