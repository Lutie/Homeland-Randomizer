<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/outils")
 */
class ToolsController extends Controller
{

    /**
     * @Route()
     */
    public function indexAction()
    {
        return $this->render('tools/index.html.twig');
    }

}