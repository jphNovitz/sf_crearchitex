<?php

namespace ISL\CrearchitexBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use ISL\CrearchitexBundle\Entity\Equipe;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="ISL\CrearchitexBundle\Repository\EquipeRepository")
 */
class Equipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="ISL\CrearchitexBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="ISL\CrearchitexBundle\Entity\Fonction", cascade={"persist"})
     */
    private $fonctions;
    
    /**
     * @var isVisible
     * 
     * @ORM\Column(name="isVisible", type="boolean", nullable=false, options={"default":true})
     */
    private $isVisible;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return equipe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return equipe
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return equipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

   
    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     *
     * @return equipe
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible
     *
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * Set image
     *
     * @param Image $image
     *
     * @return Equipe
     */
    public function setImage(Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fonction = new \Doctrine\Common\Collections\ArrayCollection();
    }

    

    /**
     * Add fonction
     *
     * @param \ISL\CrearchitexBundle\Entity\Fonction $fonction
     *
     * @return Equipe
     */
    public function addFonction(\ISL\CrearchitexBundle\Entity\Fonction $fonction)
    {
        $this->fonctions[] = $fonction;

        return $this;
    }

    /**
     * Remove fonction
     *
     * @param \ISL\CrearchitexBundle\Entity\Fonction $fonction
     */
    public function removeFonction(\ISL\CrearchitexBundle\Entity\Fonction $fonction)
    {
        $this->fonctions->removeElement($fonction);
    }

    /**
     * Get fonctions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFonctions()
    {
        return $this->fonctions;
    }
}
