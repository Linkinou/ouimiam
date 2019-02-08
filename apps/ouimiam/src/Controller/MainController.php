<?php

namespace App\Controller;

use App\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $recipeRepository = $this->getDoctrine()->getRepository(Recipe::class);
        $featuredRecipes = $recipeRepository->findAll();
        $lastestRecipes = $recipeRepository->findAll();
        $recipeOfTheDay = $recipeRepository->findOneBy(['id' => 1]);
        
        return $this->render('main/index.html.twig', [
            'featuredRecipes' => $featuredRecipes,
            'lastestRecipes' => $lastestRecipes,
            'recipeOfTheDay' => $recipeOfTheDay,
        ]);
    }
}