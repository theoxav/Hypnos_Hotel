<?php

namespace App\EventSubscriber;

use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private UrlGeneratorInterface $urlGenerator){}
   
    public function onLogoutEvent(LogoutEvent $event)
    {
        $event->getRequest()->getSession()->getFlashBag()->add(
            'success',
            'Vous êtes maintenant deconnecté'
        );

        $event->setResponse(
            new RedirectResponse($this->urlGenerator->generate('app_home'))
        );
    }

    public static function getSubscribedEvents()
    {
        return [
            LogoutEvent::class => 'onLogoutEvent',
        ];
    }
}
