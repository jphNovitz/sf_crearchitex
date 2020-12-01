<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Image;
use App\Entity\Role;

/**
 * Team
 *
 * @ORM\Table(name="team")
 */
class Team
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
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=180)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Role", cascade={"persist"})
     */
    private $role;
    
    /**
     * @var isVisible
     * 
     * @ORM\Column(name="isVisible", type="boolean", nullable=false, options={"default":true})
     */
    private $isVisible;



}
