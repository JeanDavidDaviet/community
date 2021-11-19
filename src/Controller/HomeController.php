<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', requirements: ['_locale' => 'fr|en'])]
    public function home(Request $request): Response
    {
        $locale = $request->getLocale();
        return $this->redirectToRoute('welcome', ['_locale' => $locale]);
    }

    #[Route('/{_locale}', name: 'welcome', requirements: ['_locale' => 'fr|en'])]
    public function welcome(): Response
    {
        return $this->render('welcome.html.twig');
    }
}
