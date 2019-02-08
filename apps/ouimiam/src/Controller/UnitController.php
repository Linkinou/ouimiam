<?php

namespace App\Controller;

use App\Entity\BaseIngredient;
use App\Entity\Recipe;
use App\FormType\BaseIngredientFormType;
use App\FormType\RecipeFormType;
use App\FormType\UnitFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UnitController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/unit/submit", name="submit_unit")
     *
     * @Template("unit/submit.html.twig")
     * @return array
     */
    public function submitUnitAction(Request $request)
    {
        $form = $this->createForm(UnitFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $unit = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();

            $this->addFlash('success', 'Unité ajoutée');

        }

        return [
            'form' => $form->createView()
        ];
    }
}