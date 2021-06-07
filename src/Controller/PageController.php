<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/{slug<[a-zA-Z0-9_-]+>}", name="view_page")
     */
    public function view_page(string $slug): Response
    {
      
      // from inside a controller
      $repository = $this->getDoctrine()->getRepository(Page::class);

      $page = $repository->findOneBy(['slug' => $slug]);

      return $this->render('page.html.twig', [
        'slug' => $slug,
        'page' => $page
      ]);
    }
}
