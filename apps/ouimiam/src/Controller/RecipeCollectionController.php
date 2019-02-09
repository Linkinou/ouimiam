<?php

namespace App\Controller;

use App\Entity\BaseIngredient;
use App\Entity\Recipe;
use App\Entity\RecipeCollection;
use App\FormType\RecipeCollectionFormType;
use App\Model\ShoppingListIngredient;
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
     * @Template("recipe_collection/index.html.twig")
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
     * @Template("recipe_collection/submit.html.twig")
     * @return array
     */
    public function submitRecipe(Request $request)
    {
        $form = $this->createForm(RecipeCollectionFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipeCollection = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $recipeCollection->setUser($this->getUser());
            $em->persist($recipeCollection);
            $em->flush();

            $this->addFlash('success', 'Collection ajoutée !');
        }

        return [
            'form' => $form->createView()
        ];
    }


    /**
     * @param RecipeCollection $collection
     *
     * @Route("/recipe-collection/{id}/shopping-list", name="recipe_collection_shopping_list")
     *
     * @Template("recipe_collection/shopping_list.html.twig")
     *
     * @return array
     */
    public function shoppingListAction(RecipeCollection $collection)
    {

        $recipes = $collection->getRecipes();

        $ingredientStack = [];
        /** @var Recipe $recipe */
        foreach ($recipes as $recipe) {
            /** @var BaseIngredient $ingredient */
            foreach ($recipe->getIngredients() as $ingredient) {
                $ingredientName = $ingredient->getName();

                if (array_key_exists($ingredientName, $ingredientStack)) {
                    $ingredientStack[$ingredientName]->cumulateIngredient();
                } else {
                    $ingredientStack[$ingredientName] = new ShoppingListIngredient($ingredient->getName());
                }
            }
        }

        return [
            'ingredients' => $ingredientStack,
             'collection' => $collection
        ];
    }
//    /**
//     * @param Request $request
//     *
//     * @param Recipe $recipe
//     * @return array
//     * @Route("/recipe/{id}/edit", name="edit_recipe")
//     *
//     * @Template("recipe/edit.html.twig")
//     */
//    public function editRecipe(Request $request, Recipe $recipe)
//    {
//        $form = $this->createForm(RecipeFormType::class, $recipe);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $recipe = $form->getData();
//
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($recipe);
//            $em->flush();
//        }
//
//        return [
//            'form' => $form->createView()
//        ];
//    }

    /**
     * @param RecipeCollection $recipeCollection
     *
     * @Route("/recipe-collection/{id}", name="view_recipe_collection")
     *
     * @Template("recipe_collection/view.html.twig")
     * @return array
     */
    public function viewRecipeAction(RecipeCollection $recipeCollection)
    {
        return [
            'collection' => $recipeCollection,
        ];
    }
}