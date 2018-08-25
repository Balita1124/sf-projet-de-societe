<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $auth_checker = $this->get('security.authorization_checker');
//        $token = $this->get('security.token_storage')->getToken();
//        $user = $token->getUser();
        if ($auth_checker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('list_province');
        } else {
            $helper = $this->get('security.authentication_utils');

            return $this->render(
                'auth/login.html.twig',
                array(
                    'last_username' => $helper->getLastUsername(),
                    'error' => $helper->getLastAuthenticationError(),
                    'title' => 'Se connecter | Madagascar',
                )
            );
        }
    }

    /**
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}