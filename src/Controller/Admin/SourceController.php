<?php

namespace App\Controller\Admin;

use App\Entity\Source;
use App\Entity\Project;
use App\Form\SourceType;
use App\Repository\SourceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/sources')]
class SourceController extends AbstractController
{
    /* #[Route('/', name: 'app_source_index', methods: ['GET'])]
    public function index(SourceRepository $sourceRepository): Response
    {
        return $this->render('source/index.html.twig', [
            'sources' => $sourceRepository->findAll(),
        ]);
    } */

    #[Route('/{project}' , name: 'source_project_index', methods: ['GET'])]
    public function indexProjectSource(SourceRepository $sourceRepository, Project $project): Response
    {
        return $this->render('admin/source/index.html.twig', [
            'sources' => $sourceRepository->findBy(['project' => $project]),
            'project' => $project,
        ]);
    }

    #[Route('/new/{project}', name: 'source_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Project $project, SourceRepository $sourceRepository, ManagerRegistry $doctrine): Response
    {
        $source = new Source();
        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceRepository->add($source, true);
            $project->addSource($source);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('source_project_index', [ 'project' => $project->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/source/new.html.twig', [
            'source' => $source,
            'form' => $form,
            'project' => $project,
        ]);
    }

    #[Route('/{id}', name: 'app_source_show', methods: ['GET'])]
    public function show(Source $source): Response
    {
        return $this->render('source/show.html.twig', [
            'source' => $source,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_source_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Source $source, SourceRepository $sourceRepository): Response
    {
        $form = $this->createForm(SourceType::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceRepository->add($source, true);

            return $this->redirectToRoute('app_source_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('source/edit.html.twig', [
            'source' => $source,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'source_delete', methods: ['POST'])]
    public function delete(Request $request, Source $source, SourceRepository $sourceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$source->getId(), $request->request->get('_token'))) {
            $sourceRepository->remove($source, true);
        }

        return $this->redirectToRoute('source_project_index', [ 'project' => $source->getProject()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
