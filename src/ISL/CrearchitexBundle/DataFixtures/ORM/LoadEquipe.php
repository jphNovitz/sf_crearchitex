<?php

namespace ISL\CrearchitexBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ISL\CrearchitexBundle\Entity\Equipe;
use ISL\CrearchitexBundle\Entity\Fonction;
use ISL\CrearchitexBundle\Entity\Image;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

//namespace ISL\CrearchitexBundle\Faker\Provider;


class LoadEquipe implements FixtureInterface, ContainerAwareInterface {

    private $Container;

    public function setContainer(ContainerInterface $container = null) {
        $this->Container = $container;
    }

    public function load(ObjectManager $manager) {
        $urls=array(
            "http://minimir.isl.be/novitzj/archi/images/img_team_02.jpg",
            "http://minimir.isl.be/novitzj/archi/images/img_team_01.jpg",
            "http://minimir.isl.be/novitzj/archi/images/img_team_04.jpg",
            "http://minimir.isl.be/novitzj/archi/images/img_team_03.jpg"
            );
        $fonction=array("Architecte", "Architecte d'intérieur", "Chef de projet","Fonction Fantome");
        for ($i = 0; $i < 4; $i++) {
            $faker = $this->Container->get('isl_crearchitex.provider.test');

            $e = new Equipe;

            $e->setNom($faker->nom());
            $e->setPrenom($faker->prenom());
            $e->setDescription($faker->description());
            $e->setIsVisible(true);
            
            /* ajout de l'url */
                $im= new Image; // instancie l'objet 
                $im->setUrl($urls[$i]); // met une valeur pour la propriété url
                $im->setAlt("Alt Lipsum".$i); // idem un commentaire
                $e->setImage($im); // lie la propriété image de equipe à l'entité image
                
            /* ajout des fonctions */
                $fct= new Fonction;
                $fct->setTitre($fonction[$i]);
                $fct->setDescription("une description");
                //$fct->setIsVisible(1);
              $fct->setDateAdd(new \Datetime());
                $e->addFonction($fct);

            $manager->persist($e);
            $manager->flush();
        }
    }

}
