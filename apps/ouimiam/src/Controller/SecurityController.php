<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Template("security/login.html.twig")
     *
     */
    public function LoginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        if (null !== $error) {
            $this->addFlash('danger', $error->getMessageKey());
        }

        $lastUsername = $authUtils->getLastUsername();

        return [
            'last_username' => $lastUsername,
        ];
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function LogoutAction()
    {

    }
}