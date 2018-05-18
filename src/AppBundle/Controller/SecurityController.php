<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\SignupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/sécurité", options = { "utf8": true })
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/inscription")
     */
    public function signupAction(Request $request, UserPasswordEncoderInterface $userPasswordEncoder) //UserPasswordEncoder est un service, c'est une injection de dépendance
    {

        $user = new User();

        $form = $this->createForm(SignupType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $userPasswordEncoder->encodePassword($user, $user->getRawPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Vous avez bien été enregistré.');

            return $this->redirectToRoute('app_default_index');
        }

        return $this->render('security/signup.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/connexion")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'username' => $username,
        ]);
    }

    /**
     * @Route("/hello")
     * @Security("has_role('ROLE_USER')")
     */
    public function helloAction()
    {

        $user = $this->getUser();
        $this->addFlash('success', 'Vous vous êtes connecté avec succés. Bienvenue ' . $user->getUsername() . ' !');

        return $this->redirectToRoute('app_default_index');

    }

    /**
     * @Route("/sayonara")
     * @Security("has_role('ROLE_USER')")
     */
    public function sayonaraAction()
    {

        $this->addFlash('warning', 'Vous vous êtes déconnecté avec succés. Aurevoir !');

        return $this->redirectToRoute('app_default_index');

    }

    /**
     * @Route("/redirection")
     */
    public function redirectAction()
    {

        $this->addFlash('warning', 'Vous devez être connecté pour accéder à ce contenu !');

        return $this->redirectToRoute('app_security_login');

    }

}