<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/",name ="welcome")
     */
    public function showAction(Request $request)
    {
            //Character is an associative arrays
         //not always need to convert array to string by using in twig {{list}}
        //can use for loop to iterate
            $character = [
                'Hero'               => 'zeeshan',
                'Daenerys Targaryen' => 'Emilia Clarke',
                'Jon Snow'           => 'Kit Harington',
                'Arya Stark'         => 'Maisie Williams',
                'Melisandre'         => 'Carice van Houten',
                'Khal Drogo'         => 'Jason Momoa',
                'Tyrion Lannister'   => 'Peter Dinklage',
                'Ramsay Bolton'      => 'Iwan Rheon',
                'Petyr Baelish'      => 'Aidan Gillen',
                'Brienne of Tarth'   => 'Gwendoline Christie',
                'Lord Varys'         => 'Conleth Hill'

            ];

        return $this->render('list/list.html.twig', [ 'list' => $character]);


    }
}
