<?php
namespace App\EventSubscriber;


use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setUserId'],
        ];
    }

    public function setUserId(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (($entity instanceof Suite)) {
            dd('hello');
        }

        //$user = $this->userId->setUser($entity->getUser());
        //$entity->setUser($user);
    }
}