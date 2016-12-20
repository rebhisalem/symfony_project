<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class Soutenance
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
     * @ORM\Column(type="time")
     */
    private $stime;

    public function getStime()
    {
        return $this->stime;
    }
    public function setStime($time)
    {
        $this->stime = $time;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="soutenances", cascade={"persist"})
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
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Subject", inversedBy="soutenances", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $subject;
	
    public function getSubject()
    {
        return $this->subject;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ETuteur", inversedBy="soutenances", cascade={"persist"})
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
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="soutenances_encadrant", cascade={"persist"})
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
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="soutenances_examinateur", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $examinateur;
	
    public function getExaminateur()
    {
        return $this->examinateur;
    }
    public function setExaminateur($examinateur)
    {
        $this->examinateur = $examinateur;
    }
	
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student", inversedBy="soutenances", cascade={"persist"})
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
	
}