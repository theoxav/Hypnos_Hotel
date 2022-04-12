<?php

namespace App\EventSubscriber;

use App\Entity\Suite;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(private Security $security, private UserPasswordHasherInterface $passwordHasher)
    {}
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEntityUser'],
            BeforeEntityUpdatedEvent::class => ['updatePassword'],
        ];
    }

    public function setEntityUser(BeforeEntityPersistedEvent $event)
    {
       $entity = $event->getEntityInstance();

       if (!$entity instanceof Suite) return;
       

       $user = $this->security->getUser();
       $suiteUser = $this->security->getUser()->getEstablishement();
       $entity->setUser($user);
       $entity->setEstablishement($suiteUser);
    }

    public function updatePassword(BeforeEntityUpdatedEvent $event, $user)
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof User) return;

        $plainPassword = $entity->getPassword();
        $hashPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);

        $entity->setPassword($hashPassword);
        
    }
   
}