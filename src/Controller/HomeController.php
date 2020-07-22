<?php

namespace App\Controller;

use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\ContactRepository;
use App\Repository\FormationRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param SkillRepository $skillRepository
     * @param FormationRepository $formationRepository
     * @param ContactRepository $contactRepository
     * @return Response
     */
    public function index(ProjectRepository $projectRepository,
                          SkillRepository $skillRepository,
                          FormationRepository $formationRepository,
                          ContactRepository $contactRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'skills' => $skillRepository->findAll(),
            'formations' => $formationRepository->findAll(),
            'contact' =>$contactRepository->findBy([]),
        ]);
    }

    /**
     * @Route("/skill"), name="add_skill")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addSkill(Request $request, EntityManagerInterface $entityManager, SkillRepository $skillRepository): Response
    {
        $newSkill = new Skill();
        $form = $this->createForm(SkillType::class, $newSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSkill = $form->getData();

            $entityManager->persist($newSkill);
            $entityManager->flush();
        }

        return $this->render('admin/add_skill.html.twig', [
            'form' => $form->createView(),
            'skill' => $skillRepository->findAll(),
        ]);
    }
}
