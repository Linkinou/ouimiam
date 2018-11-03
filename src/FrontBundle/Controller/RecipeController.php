<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\Recipe;
use FrontBundle\FormType\RecipeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/recipes", name="recipe_index")
     *
     * @Template("@Front/recipe/index.html.twig")
     * @return array
     */
    public function indexAction(Request $request)
    {
        return [
            'recipes' => $this->getDoctrine()->getRepository(Recipe::class)->findAll()
        ];
    }

    /**
     * @param Request $request
     *
     * @Route("/recipe/submit", name="submit_recipe")
     *
     * @Template("@Front/recipe/submit.html.twig")
     * @return array
     */
    public function submitRecipeAction(Request $request)
    {
        $form = $this->createForm(RecipeFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newRecipe = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $newRecipe->setUser($this->getUser());
            $em->persist($newRecipe);
            $em->flush();

            $this->addFlash('success', 'Recette ajoutée !');

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
            $recipe->setUser($this->getUser());
            $em->persist($recipe);
            $em->flush();

            $this->addFlash('success', 'Recette éditée !');
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