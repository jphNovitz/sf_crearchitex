<?php

namespace ISL\CrearchitexBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ISL\CrearchitexBundle\Entity\Equipe;
use ISL\CrearchitexBundle\Entity\Fonction;
use ISL\CrearchitexBundle\Form\EquipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {

        return $this->render('ISLCrearchitexBundle:Default:index.html.twig');
    }

    public function equipeAction() {
        $repo = $this->getDoctrine()->getRepository('ISLCrearchitexBundle:Equipe');
        $equipe = $repo->findAll();

        foreach ($equipe as $membre) {
            $membre->url = $membre->getImage()->getUrl();
        }
        foreach ($equipe as $membre) {
            $membre->fonction = $membre->getFonctions();
        }


        return $this->render('ISLCrearchitexBundle:Default:equipe.html.twig', array('equipe' => $equipe));
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
