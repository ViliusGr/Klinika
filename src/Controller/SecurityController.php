<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils, TranslatorInterface $translator): Response
    {
        $error = $utils->getLastAuthenticationError();
        /*if(!isset($error) && isset($_POST["_password"])){
            $this->addFlash('success', "Jūs sėkmingai prisijungėte!");
        }*/
        $lastUsername = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

    }


}
