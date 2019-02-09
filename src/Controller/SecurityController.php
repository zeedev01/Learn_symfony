<?php

namespace App\Controller;

//use App\Form\UserType;
//use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class SecurityController extends Controller
{
    /**
     * @Route("/{_locale}/login",name="login",requirements={"_locale"="%app.locales%"})
     *
     */
    public function loginAction(Request $request)
    {

        //$form = $this->createForm(UserType::class);
        //$form->handleRequest($request);
        $helper = $this->get('security.authentication_utils');
        return new Response($this->renderView('security/auth.html.twig',
            array(
                'last_username' => $helper->getLastUsername(),//the last username entered by the user
                'error' => $helper->getLastAuthenticationError(),//get login error ,if there is one error
                //'form' =>$form->createView()
            )
        )

        );

    }
    /**
     * @Route("/logout",name="logout")
     */
    public function logoutAction()
    {

          return new Response($this->redirect('login'));
    }
}
