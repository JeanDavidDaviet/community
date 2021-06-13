<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/{_locale}', name: 'home', requirements: ['_locale' => 'fr|en'])]
    public function home(): Response
    {
      return $this->render('home.html.twig');
    }
    
    #[Route('/welcome', name: 'welcome')]
    public function welcome(): Response
    {
      return $this->render('welcome.html.twig');
    }
}
