<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/20/2018
 * Time: 3:48 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EditPage extends Controller
{
    /**
     * @Route("/{_locale}/edit",name="edit",requirements={"_locale"="%app.locales%"},defaults={"_locale": "de"})
     *
     */
    public function editAction()
    {
        return new Response($this->renderView('edit/edit.html.twig'));

    }
}