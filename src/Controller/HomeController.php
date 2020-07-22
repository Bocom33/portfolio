<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ContactRepository;
use App\Repository\FormationRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * @param ProjectRepository $projectRepository
     * @param SkillsRepository $skillsRepository
     * @param FormationRepository $formationRepository
     * @param ContactRepository $contactRepository
     * @return Response
     */
    public function index(ProjectRepository $projectRepository,
                          SkillsRepository $skillsRepository,
                          FormationRepository $formationRepository,
                          ContactRepository $contactRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'skills' => $skillsRepository->findAll(),
            'formations' => $formationRepository->findAll(),
            'contact' =>$contactRepository->findBy([]),
        ]);
    }
}
