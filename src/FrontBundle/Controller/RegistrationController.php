<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\HungryUser;
use FrontBundle\FormType\HungryUserFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     *
     * @Route("/registration", name="user_registration")
     *
     * @Template("@Front/security/registration.html.twig")
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function RegistrationAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new HungryUser();
        $form = $this->createForm(HungryUserFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return [
            'form' => $form->createView()
        ];
    }
}