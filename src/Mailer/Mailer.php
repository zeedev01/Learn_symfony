<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/19/2018
 * Time: 5:20 PM
 */

namespace App\Mailer;


use App\Entity\User;

class Mailer
{
    /**
     * @var $swift_Mailer
     */
    private $swift_Mailer;

    /**
     * @var $twig_Environment
     */
    private $twig_Environment;


    /**
     * @var string
     */
   // private $mailFrom;


        public function __construct(\Swift_Mailer $swift_Mailer, \Twig_Environment $twig_Environment)//string $mailFrom)
        {
            $this->swift_Mailer = $swift_Mailer;
            $this->twig_Environment = $twig_Environment;
            //$this->mailFrom = $mailFrom;
        }

    /**
     * @param User $user
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendConfirmationEmail(User $user)
        {

            $body = $this->twig_Environment->render( 'email/email.html.twig', [
                    'user' => $user
                ]
            );
            $message = (new \Swift_Message())
                ->setSubject( 'WELCOME TO HOMESTEAD APP' )
                //->setFrom($this->mailFrom)
                ->setTo( $user->getEmail() )
                ->setBody( $body, 'text/html' );

                $this->swift_Mailer->send($message);
        }
}