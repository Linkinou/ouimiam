<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\BaseIngredient;
use AppBundle\Entity\Recipe;
use FrontBundle\FormType\BaseIngredientFormType;
use FrontBundle\FormType\DifficultyFormType;
use FrontBundle\FormType\RecipeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DifficultyController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/difficulty/submit", name="submit_difficulty")
     *
     * @Template("@Front/difficulty/submit.html.twig")
     * @return array
     */
    public function submitDifficultytAction(Request $request)
    {
        $form = $this->createForm(DifficultyFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $difficulty = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($difficulty);
            $em->flush();

            $this->addFlash('success', 'Difficulté ajoutée');
        }

        return [
            'form' => $form->createView()
        ];
    }
}