<?php

namespace App\Controller;

use App\Entity\PageGroup;
use App\Form\PageGroupType;
use App\Repository\PageGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/page_group')]
class PageGroupController extends AbstractController
{
    #[Route('/', name: 'page_group_index', methods: ['GET'])]
    public function index(PageGroupRepository $pageGroupRepository): Response
    {
        return $this->render('page_group/index.html.twig', [
            'page_groups' => $pageGroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'page_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pageGroup = new PageGroup();
        $form = $this->createForm(PageGroupType::class, $pageGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pageGroup);
            $entityManager->flush();

            return $this->redirectToRoute('page_group_index');
        }

        return $this->render('page_group/new.html.twig', [
            'page_group' => $pageGroup,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'page_group_show', methods: ['GET'])]
    public function show(PageGroup $pageGroup): Response
    {
        return $this->render('page_group/show.html.twig', [
            'page_group' => $pageGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'page_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PageGroup $pageGroup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PageGroupType::class, $pageGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('page_group_index');
        }

        return $this->render('page_group/edit.html.twig', [
            'page_group' => $pageGroup,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'page_group_delete', methods: ['POST'])]
    public function delete(Request $request, PageGroup $pageGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pageGroup->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pageGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('page_group_index');
    }
}
