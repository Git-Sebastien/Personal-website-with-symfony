<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact.index')]
    public function index():Response
    {
        return $this->render("contact/index.html.twig");
    }

    #[Route('/contact-data', name: 'contact.data')]
    public function getData(Request $request)
    {
        dd($request->get('name','firstname'));
    }
}