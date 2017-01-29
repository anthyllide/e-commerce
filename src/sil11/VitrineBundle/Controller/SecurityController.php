<?php

namespace sil11\VitrineBundle\Controller;

use sil11\VitrineBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request) {

        $session = $request->getSession();

        // récupérer les erreurs de login s'il y en a

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }
        // dernier login entré par l'utilisateur
        return $this->render('sil11VitrineBundle:Security:login.html.twig', array(
        'last_username' => $session->get(Security::LAST_USERNAME),
        'error' => $error,
        ));
    }
}
