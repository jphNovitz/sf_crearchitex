<?php

namespace App\Controller\Project;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Team;
use App\Entity\Role;
use Symfony\Component\Routing\Annotation\Route;

//use App\Form\EquipeType;

class ProjectController extends AbstractController
{

    protected $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repo = $entityManager->getRepository('App:Project');
    }


    /**
     * @Route("/projets", name="projects_list")
     */
    public function projects()
    {

        $projects = $this->repo->findAllProjects();

        return $this->render('Project/projets.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/project/{id}", name="project_card")
     */
    public function Project($id = null)
    {
        $project = $this->repo->findProject($id);

        return $this->render('projets.html.twig', ['project' => $project]);
    }


}
