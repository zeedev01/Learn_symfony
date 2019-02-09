<?php

namespace App\Controller;

use App\Entity\User;
use App\EventSubscriber\UserRegisterEvent;
use App\Form\UserType;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

//todo here the registration form --> take form... from UserType and goes to Entity\User
class RegistrationController extends Controller
{
    /**
     * @Route("/{_locale}/register",name="register",requirements={"_locale"="%app.locales%"},defaults={"_locale": "de"})
     *
     */
    public function registerAction(Request $request , EventDispatcherInterface $eventDispatcher)
    {
        //create a blank user and process the form
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid())
        {
            // Encode the new users password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            //set their role
            $user->setRole('ROLE_USER');
            //$user->setRole('ADMIN_USER');

            //save to database
            //$user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);//make data get ready to save to database   before applying the changes
            $em->flush();//apply the changes

            $userRegisterEvent = new UserRegisterEvent($user);
            $eventDispatcher->dispatch(UserRegisterEvent::NAME,$userRegisterEvent);



            return $this->redirectToRoute('welcome');

        }
        return $this->render('register/register.html.twig',
            [
            'form' => $form->createView(),
            ] );// here twig will dsplay the form to filled through createView()
    }
}
