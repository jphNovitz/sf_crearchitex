<?php

namespace ISL\CrearchitexBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use ISL\CrearchitexBundle\Entity\Equipe;
use ISL\CrearchitexBundle\Form\EquipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {

    public function adminAction() {
        return $this->render('ISLCrearchitexBundle:Admin:index'
                        . '.html.twig');
    }

    /* liste */

    public function equipeListeAction() {
        $repo = $this->getDoctrine()->getRepository('ISLCrearchitexBundle:Equipe');
        $equipe = $repo->findAll();

        foreach ($equipe as $membre) {
            $membre->url = $membre->getImage()->getUrl();
        }
        foreach ($equipe as $membre) {
            $membre->fonction = $membre->getFonctions();
        }


        return $this->render('ISLCrearchitexBundle:Admin:equipe.html.twig', array('equipe' => $equipe));
    }

    /* ajouts    */

    public function equipeAjouterAction(Request $request) {


        $e = new Equipe();
        $e->setIsVisible(true);

        $form = $this->createForm(EquipeType::class, $e);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($e);
            $em->flush();
            return $this->redirectToRoute('crearchitex_admin_equipe_liste');
        } else {

            return $this->render('ISLCrearchitexBundle:Admin:equipe-ajouter.html.twig', array('form' => $form->createView()));
        }
        /*
         * J'ai fait cela pour tester au départ c'est fini je me lance vers un FORMULAIRE !
         */
        /* $e = new equipe;
          $e->setNom("Doe");
          $e->setPrenom("John");
          $e->setDescription("Architecte en  chef");
          $e->setIsVisible(true);
          $em = $this->getDoctrine()->getManager();
          $em->persist($e);
          $em->flush();
          /*         * ** */
    }

    public function equipeModifierAction(Request $request, $id) {
        if ($id == null) {
            return $this->redirectToRoute('crearchitex_equipe');
        }

        $e = new Equipe();

        $em = $this->getDoctrine()->getRepository('ISLCrearchitexBundle:Equipe');
        $e = $em->find($id);

        $form = $this->createForm(EquipeType::class, $e);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($e);
            $em->flush();
            return $this->redirectToRoute('crearchitex_admin_equipe_liste');
        } else {

            return $this->render('ISLCrearchitexBundle:Admin:equipe-modifier.html.twig', array('form' => $form->createView(), 'id' => $id));
        }
    }

    public function equipeSupprimerAction($id) {
        if ($id == null) {
            return $this->redirectToRoute('crearchitex_equipe');
        }

        $e = new Equipe();
        $rep = $this->getDoctrine()->getRepository('ISLCrearchitexBundle:Equipe');
        $e = $rep->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($e);
        $em->flush();


        return $this->redirectToRoute('crearchitex_admin_equipe_liste');
    }

}
