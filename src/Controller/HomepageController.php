<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\WebsiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ProjectRepository $projectRepository, WebsiteRepository $websiteRepository): Response
    {
        return $this->render('homepage/index.html.twig', [
                                                        'projects' => $projectRepository->findAll(),
                                                        'website' => $websiteRepository->findAll(),
                                                        ]);
    }
}
