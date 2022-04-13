<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Entity\Suite;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(private Security $security, private UserPasswordHasherInterface $passwordHasher, private RequestStack $requestStack)
    {}
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEntityUser'],
            BeforeEntityUpdatedEvent::class => ['updatePassword'],

            AfterEntityPersistedEvent::class => ['flashMessageAfterPersist'],
            AfterEntityUpdatedEvent::class => ['flashMessageAfterUpdate'],
            AfterEntityDeletedEvent::class => ['flashMessageAfterDelete'],
        ];
    }

    // AUTOMATIC USER ADDITION TO A SUITE
    public function setEntityUser(BeforeEntityPersistedEvent $event)
    {
       $entity = $event->getEntityInstance();

       if (!$entity instanceof Suite) return;
       

       $user = $this->security->getUser();
       $suiteUser = $this->security->getUser()->getEstablishement();
       $entity->setUser($user);
       $entity->setEstablishement($suiteUser);
    }

    // HASH PASSWORD AFTER CHANGE
    public function updatePassword(BeforeEntityUpdatedEvent $event, $user)
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof User) return;

        $plainPassword = $entity->getPassword();
        $hashPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);

        $entity->setPassword($hashPassword);
        
    }


    // Flash Message
    public function flashMessageAfterPersist(AfterEntityPersistedEvent $event): void
    {
        $this->requestStack->getSession()->getFlashBag()->add('success',$event->getEntityInstance().' successfully created');
    }

    public function flashMessageAfterUpdate(AfterEntityUpdatedEvent $event): void
    {
        $this->requestStack->getSession()->getFlashBag()->add('success', (string)$event->getEntityInstance() .' successfuly updated');
    }

    public function flashMessageAfterDelete(AfterEntityDeletedEvent $event): void
    {
        $this->requestStack->getSession()->getFlashBag()->add('success', (string)$event->getEntityInstance(). ' successfully deleted');
    }
}
   
