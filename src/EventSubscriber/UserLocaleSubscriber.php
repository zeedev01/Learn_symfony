<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/20/2018
 * Time: 11:40 AM
 */

namespace App\EventSubscriber;


use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class UserLocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            SecurityEvents::INTERACTIVE_LOGIN => [
                [
                    'onInteractiveLogin',
                    15
                ]
            ]
        ];
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {

        // Todo here can be used to get the user_perferences from user_perference table and logs in
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();

      // $this->session->set('_locale', $user->getPreferences()->getLocale());
    }
}