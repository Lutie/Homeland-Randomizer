<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route()
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Locale
     * @param Request $request Request
     * @param string $locale Locale
     *
     * @return RedirectResponse
     * @Route("/{locale}", requirements={"locale":"fr|en"})
     */
    public function localeAction(Request $request, $locale)
    {
        $request->getSession()->set('locale', $locale);

        return $this->redirectToRoute('app_default_index');
    }
}
