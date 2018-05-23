<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractController extends controller
{

    public function isTokenValid($token, $intention)
    {
        if ($token === null) {
            throw $this->createNotFoundException();
        }

        if (!$this->isCsrfTokenValid($intention, $token)) {
            throw $this->createNotFoundException();
        }
    }

    public function em()
    {
        return $em = $this->getDoctrine()->getManager();
    }

}