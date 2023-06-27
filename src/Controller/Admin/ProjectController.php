<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Form\SearchProgramType;
use App\Form\SearchProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'project_index', methods: ['GET', 'POST'])]
    public function index(Request $request, ProjectRepository $projectRepository): Response
    {
        $form = $this->createForm(SearchProjectType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $projects = $projectRepository->findLikeName($search);
        } else {
            $projects = $projectRepository->findAll();
        }



        return $this->render('admin/project/index.html.twig', [
            'projects' => $projects,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'project_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProjectRepository $projectRepository): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectRepository->add($project, true);

            return $this->redirectToRoute('project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/project/new.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }


    
    /**
     * @Route("/image", name="project_image", methods={"POST"}, options={"expose"=true})
     * @param Request $request
     * @return JsonResponse
     */
    public function getImage(Request $request, EntityManagerInterface $em)
    {
        
        if ($request->isXmlHttpRequest())
        {
            $project = new Project();
            $form = $this->createForm(ProjectType::class, $project);
            $form->handleRequest($request);
            // the file
            $file = $_FILES['file'];
            $file = new UploadedFile($file['tmp_name'], $file['name'], $file['type']);
            $filename = $this->generateUniqueName() . '.' . $file->guessExtension();
            $file->move(
                $this->getTargetDir(),
                $filename
            );
            $project->setImageProjectName($filename);
            //$em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_index');
        }
        return new JsonResponse("This is not an ajax request");

    }

    private function generateUniqueName()
    {
        return md5(uniqid());
    }

    private function getTargetDir()
    {
        return $this->getParameter('upload_directory_projects');
    }

    #[Route('/{id}', name: 'project_show', methods: ['GET'], requirements:["id"=>"\d+"])]
    public function show(Project $project): Response
    {
        return $this->render('admin/project/show.html.twig', [
            'project' => $project,
        ]);
    }

    #[Route('/{id}/edit', name: 'project_edit', methods: ['GET', 'POST'], requirements:["id"=>"\d+"])]
    public function edit(Request $request, Project $project, ProjectRepository $projectRepository): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectRepository->add($project, true);

            return $this->redirectToRoute('project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'project_delete', methods: ['POST'], requirements:["id"=>"\d+"])]
    public function delete(Request $request, Project $project, ProjectRepository $projectRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $projectRepository->remove($project, true);
        }

        return $this->redirectToRoute('project_index', [], Response::HTTP_SEE_OTHER);
    }

}
