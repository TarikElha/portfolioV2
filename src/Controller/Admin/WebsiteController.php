<?php

namespace App\Controller\Admin;

use App\Entity\Website;
use App\Form\WebsiteType;
use App\Repository\WebsiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/website')]
class WebsiteController extends AbstractController
{
    #[Route('/', name: 'website_index', methods: ['GET'])]
    public function index(WebsiteRepository $websiteRepository, Request $request): Response
    {
        $website = $websiteRepository->findAll();
        $form = null;
        if($website){
            $form = $this->createForm(WebsiteType::class, $website[0]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $websiteRepository->add($website, true);

                return $this->redirectToRoute('website_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('admin/website/index.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);

    }

    #[Route('/new', name: 'website_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WebsiteRepository $websiteRepository): Response
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $websiteRepository->add($website, true);

            return $this->redirectToRoute('website_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/website/new.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_website_show', methods: ['GET'])]
    public function show(Website $website): Response
    {
        return $this->render('website/show.html.twig', [
            'website' => $website,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_website_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Website $website, WebsiteRepository $websiteRepository): Response
    {
        $form = $this->createForm(WebsiteType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $websiteRepository->add($website, true);

            return $this->redirectToRoute('app_website_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('website/edit.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'website_delete', methods: ['POST'])]
    public function delete(Request $request, Website $website, WebsiteRepository $websiteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$website->getId(), $request->request->get('_token'))) {
            $websiteRepository->remove($website, true);
        }

        return $this->redirectToRoute('website_index', [], Response::HTTP_SEE_OTHER);
    }
}
