<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class EResponsable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
	
	public function getId()
    {
        return $this->id;
    }
    /**
     * @ORM\Column(type="string")
     */
	private $firstname;
	
    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname($fname)
    {
        $this->firstname = $fname;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $lastname;
	
    public function getLastname()
    {
        return $this->lastname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $grade;
	
    public function getgrade()
    {
        return $this->grade;
    }
    public function setgrade($grade)
    {
        $this->grade = $grade;
    }
	
		/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subject", mappedBy="eresponsable", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $subjects;
	 

}