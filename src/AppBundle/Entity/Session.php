<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class Session
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
     * @ORM\Column(type="date")
     */
    private $sdate;

    public function getSdate()
    {
        return $this->sdate;
    }
    public function setSdate($sdate)
    {
        $this->sdate = $sdate;
    }
	
	/**
     * @ORM\Column(type="integer")
     */
    private $year;

    public function getYear()
    {
        return $this->year;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }
	
	/**
     * @ORM\Column(type="string")
     */
    private $month;

    public function getMonth()
    {
        return $this->month;
    }
    public function setMonth($month)
    {
        $this->month = $month;
    }
	
	/**
     * @ORM\Column(type="string")
     */
    private $stype;

    public function getStype()
    {
        return $this->stype;
    }
    public function setStype($stype)
    {
        $this->stype = $stype;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Section", inversedBy="sessions", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $section;
	
    public function getSection()
    {
        return $this->section;
    }
    public function setSection($section)
    {
        $this->section = $section;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classroom", inversedBy="sessions", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $classroom;
	
    public function getClassroom()
    {
        return $this->classroom;
    }
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;
    }

	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="sessions", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $president;
	
    public function getPresident()
    {
        return $this->president;
    }
    public function setPresident($president)
    {
        $this->president = $president;
    }
	
	/**
   * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Soutenance", cascade={"persist", "remove"})
   * @ORM\JoinColumn(nullable=true)
   * @ORM\OrderBy({"stime" = "ASC"})
   */
	private $soutenances;
	
    public function getSoutenances()
    {
        return $this->soutenances;
		
    }
    public function setSoutenances($soutenances)
    {
        $this->soutenances = $soutenances;
    }
	
	


}