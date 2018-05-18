<?php

namespace AppBundle\Translation;

use AppBundle\Entity\User;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LocaleEventListener
{

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    private $locale;

    /**
     * @param TokenStorageInterface $tokenStorage Token storage
     * @param string $locale locale
     */
    public function __construct(TokenStorageInterface $tokenStorage, $locale)
    {
        $this->tokenStorage = $tokenStorage;
        $this->locale = $locale;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event) // l'événement appelé par défaut pour le kernel listener, par défaut ils envoient la requête dans $event
    {
        $session = $event->getRequest()->getSession();
        $locale = $session->get('locale', '%locale%'); // %locale% fait référence à ma locale dans les configs, nous c'est "fr"

        if (null !== $token = $this->tokenStorage->getToken()) {
            if (null !== $user = $token->getUser()) {
                if ($user instanceof User) {
                    $locale = $user->getLocale();
                }
            }
        }

        $event->getRequest()->setLocale($locale);
    }

}