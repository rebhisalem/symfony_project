<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class ETuteur
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
     * @ORM\Column(type="string")
     */
	private $gsm;
	
    public function getgsm()
    {
        return $this->gsm;
    }
    public function setgsm($gsm)
    {
        $this->gsm = $gsm;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $email;
	
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email = $email;
    }
	
	public function __toString()
	{
		return (string) $this->getFirstname()." ".$this->getLastname() ;
	}
	
		/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subject", mappedBy="etuteur", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $subjects;
	 
	  /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soutenance", mappedBy="etuteur", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $soutenances;
	 
}