<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Team;
use App\Entity\Role;
use Symfony\Component\Routing\Annotation\Route;

//use App\Form\EquipeType;

class DefaultController extends AbstractController
{

    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="default")
     */
    public function index()
    {

        return $this->render('Default/index.html.twig');
    }

    /**
     * @Route("/equipe", name="members_list")
     */
    public function Members()
    {
        $repo = $this->entityManager->getRepository('App:Member');
        $members = $repo->findAllMembers();

        return $this->render('Default/Members/members.html.twig', ['members' => $members]);
    }

    /**
     * @Route("/profile/{id}", name="membere_profile")
     */
    public function Member($id = null)
    {
        $repo = $this->entityManager->getRepository('App:Member');
        $members = $repo->findMember($id);

        return $this->render('Default/Members/member.html.twig', ['member' => $member]);
    }




    public function projetAction() {
        return $this->render('ISLCrearchitexBundle:Default:projet.html.twig');
    }

    public function newsAction() {
        return $this->render('ISLCrearchitexBundle:Default:news.html.twig');
    }

    public function contactAction() {
        return $this->render('ISLCrearchitexBundle:Default:contact.html.twig');
    }


}
