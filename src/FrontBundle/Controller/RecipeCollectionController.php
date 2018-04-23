<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\Recipe;
use AppBundle\Entity\RecipeCollection;
use FrontBundle\FormType\RecipeCollectionFormType;
use FrontBundle\FormType\RecipeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeCollectionController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/recipe-collections", name="recipe_collection_index")
     *
     * @Template("@Front/recipe_collection/index.html.twig")
     * @return array
     */
    public function indexAction(Request $request)
    {
        return [
            'collections' => $this->getDoctrine()->getRepository(RecipeCollection::class)->findAll()
        ];
    }

    /**
     * @param Request $request
     *
     * @Route("/recipe-collection/submit", name="submit_recipe_collection")
     *
     * @Template("@Front/recipe_collection/submit.html.twig")
     * @return array
     */
    public function submitRecipe(Request $request)
    {
        $form = $this->createForm(RecipeCollectionFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipeCollection = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipeCollection);
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
    public function editRecipe(Request $request, Recipe $recipe)
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
     * @Template("@Front/recipe/index.html.twig")
     * @return array
     */
    public function viewRecipeAction(Recipe $recipe)
    {
        return [
            'recipe' => $recipe,
        ];
    }
}