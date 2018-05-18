<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/règles", options = { "utf8": true })
 */
class RulesController extends Controller
{
    /**
     * @Route()
     */
    public function indexAction()
    {
        return $this->render('rules/index.html.twig');
    }
}