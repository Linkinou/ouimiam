<?php

namespace FrontBundle\Controller;

use AppBundle\Entity\HungryUser;
use FrontBundle\FormType\HungryUserFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     *
     * @param AuthenticationUtils $authUtils
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/login", name="user_login")
     *
     * @Template("@Front/security/login.html.twig")
     *
     */
    public function LoginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return [
            'last_username' => $lastUsername,
            'error'         => $error,
        ];
    }
}