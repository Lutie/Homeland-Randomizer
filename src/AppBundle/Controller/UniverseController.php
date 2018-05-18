<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/univers")
 */
class UniverseController extends Controller
{
    /**
     * @Route()
     */
    public function indexAction()
    {
        return $this->render('universe/index.html.twig');
    }
}