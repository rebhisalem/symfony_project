<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class Subject
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
     * @ORM\Column(type="string", unique=true)
     */
    private $subjectTitle;

    public function getsubjectTitle()
    {
        return $this->subjectTitle;
    }
    public function setsubjectTitle($subjectTitle)
    {
        $this->subjectTitle = $subjectTitle;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="subjects", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $company;
	
    public function getCompany()
    {
        return $this->company;
    }
    public function setCompany($company)
    {
        $this->company = $company;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EResponsable", inversedBy="subjects", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $eResponsable;
	
    public function getEResponsable()
    {
        return $this->eResponsable;
    }
    public function setEResponsable($eResponsable)
    {
        $this->eResponsable = $eResponsable;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ETuteur", inversedBy="subjects", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $eTuteur;
	
    public function getETuteur()
    {
        return $this->eTuteur;
    }
    public function setETuteur($eTuteur)
    {
        $this->eTuteur = $eTuteur;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="subjects", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $encadrant;
	
    public function getEncadrant()
    {
        return $this->encadrant;
    }
    public function setEncadrant($encadrant)
    {
        $this->encadrant = $encadrant;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="subjects", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $coencadrant;
	
    public function getCoEncadrant()
    {
        return $this->coencadrant;
    }
    public function setCoEncadrant($coencadrant)
    {
        $this->coencadrant = $coencadrant;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student", inversedBy="subjects", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $student;
	
    public function getStudent()
    {
        return $this->student;
    }
    public function setStudent($student)
    {
        $this->student = $student;
    }
	
	/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soutenance", mappedBy="subject", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $soutenances;
	 
	public function __toString()
	{
		return (string) $this->getsubjectTitle() ;
	}
}