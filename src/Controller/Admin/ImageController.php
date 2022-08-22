<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Project;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/image')]
class ImageController extends AbstractController
{
    /* #[Route('/', name: 'image_index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('admin/image/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    } */

    #[Route('/{project}' , name: 'image_project_index', methods: ['GET'])]
    public function indexProjectImage(ImageRepository $imageRepository, Project $project): Response
    {
        return $this->render('admin/image/index.html.twig', [
            'images' => $imageRepository->findBy(['project' => $project]),
            'project' => $project,
        ]);
    }

    #[Route('/new/{project}', name: 'image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageRepository $imageRepository, Project $project, ManagerRegistry $doctrine): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);
            $project->addImage($image);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('image_project_index', [ 'project' => $project->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/image/new.html.twig', [
            'image' => $image,
            'form' => $form,
            'project' => $project,
        ]);
    }

    /* #[Route('/new', name: 'image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageRepository $imageRepository): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);

            return $this->redirectToRoute('image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/image/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    } */

    #[Route('/{id}', name: 'image_show', methods: ['GET'])]
    public function show(Image $image): Response
    {
        return $this->render('admin/image/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/edit', name: 'image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);

            return $this->redirectToRoute('image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/image/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'image_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $imageRepository->remove($image, true);
        }
        return $this->redirectToRoute('image_project_index', [ 'project' => $image->getProject()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
