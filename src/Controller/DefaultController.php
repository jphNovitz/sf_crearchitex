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



    public function newsAction() {
        return $this->render('ISLCrearchitexBundle:Default:news.html.twig');
    }

    public function contactAction() {
        return $this->render('ISLCrearchitexBundle:Default:contact.html.twig');
    }


}
