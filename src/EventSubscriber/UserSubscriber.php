<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/18/2018
 * Time: 11:37 AM
 */

namespace App\EventSubscriber;


use App\Entity\UserPreferences;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{


    //private $mailer;

    /**
     * @var string
     */
    private $defaultLocale;
    /**
     * @var $entityManager
     */
    private $entityManager;

    public function __construct(string $defaultLocale, EntityManagerInterface $entityManager)
        {
          //  $this->mailer =$mailer;
            //Mailer $mailers
            $this->defaultLocale = $defaultLocale;
            $this->entityManager =$entityManager;
        }


    public static function getSubscribedEvents()
    {
        return [
            UserRegisterEvent::NAME => 'onUserRegister'
        ];
    }

    public function onUserRegister(UserRegisterEvent $event)
    {
        //Todo here we can get the preferences from the locale (set by default_locale)
         $preferences = new UserPreferences();

         $preferences->setLocale($this->defaultLocale);

         $user = $event->getRegisteredUser();


         $this->entityManager->flush();

          //  $this->mailer->sendConfirmationEmail($event ->getRegisteredUser());

    }
}