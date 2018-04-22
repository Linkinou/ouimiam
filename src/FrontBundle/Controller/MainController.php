<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    /**
     * @Route("/", name="home")
     *
     * @Template("FrontBundle:main:index.html.twig")
     */
    public function indexAction()
    {
        $recipeRepository = $this->getDoctrine()->getRepository(Recipe::class);
        $featuredRecipes = $recipeRepository->findAll();
        $lastestRecipes = $recipeRepository->findAll();
        $recipeOfTheDay = $recipeRepository->findOneBy(['id' => 1]);
        
        return [
            'featuredRecipes' => $featuredRecipes,
            'lastestRecipes' => $lastestRecipes,
            'recipeOfTheDay' => $recipeOfTheDay,
        ];
    }
}