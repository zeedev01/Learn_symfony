<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/18/2018
 * Time: 2:33 PM
 */

namespace App\EventSubscriber;


use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegisterEvent extends Event
{
     const NAME = 'user.register'; //this name of the eventname used in EventDispatcherInterface in Registration Controller
     private $registeredUser;
    /**
     * @param User $registeredUser
     */
    public function __construct(User $registeredUser)
    {
        $this->registeredUser = $registeredUser;
    }

    public function getRegisteredUser(): User
    {
        return $this->registeredUser;
    }
}