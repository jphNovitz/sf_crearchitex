<?php

namespace App\Controller\Member;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Team;
use App\Entity\Role;
use Symfony\Component\Routing\Annotation\Route;

//use App\Form\EquipeType;

class MemberController extends AbstractController
{

    protected $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repo = $entityManager->getRepository('App:Member');
    }


    /**
     * @Route("/equipe", name="members_list")
     */
    public function Members()
    {

        $members = $this->repo->findAllMembers();

        return $this->render('Member/members.html.twig', ['members' => $members]);
    }

    /**
     * @Route("/profile/{id}", name="membere_profile")
     */
    public function Member($id = null)
    {
        $member = $this->repo->findMember($id);

        return $this->render('Member/member.html.twig', ['member' => $member]);
    }


}
