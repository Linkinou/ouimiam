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

            $this->addFlash('success', 'Ingrédient ajouté');
        }

        return [
            'form' => $form->createView()
        ];
    }
}