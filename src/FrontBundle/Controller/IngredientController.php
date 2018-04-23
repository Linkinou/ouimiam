<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\BaseIngredient;
use AppBundle\Entity\Recipe;
use FrontBundle\FormType\BaseIngredientFormType;
use FrontBundle\FormType\RecipeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/ingredient/submit", name="submit_ingredient")
     *
     * @Template("@Front/ingredient/submit.html.twig")
     * @return array
     */
    public function submitIngredientAction(Request $request)
    {
        $form = $this->createForm(BaseIngredientFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     *
     * @param Recipe $recipe
     * @return array
     * @Route("/recipe/{id}/edit", name="edit_recipe")
     *
     * @Template("@Front/recipe/edit.html.twig")
     */
    public function editRecipeAction(Request $request, Recipe $recipe)
    {
        $form = $this->createForm(RecipeFormType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe = $form->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Recipe $recipe
     *
     * @Route("/recipe/{id}", name="view_recipe")
     *
     * @Template("@Front/recipe/view.html.twig")
     * @return array
     */
    public function viewRecipeAction(Recipe $recipe)
    {
        return [
            'recipe' => $recipe,
        ];
    }
}