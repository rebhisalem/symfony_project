<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Proposition
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
   * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student")
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
     * @ORM\Column(type="string")
     */
    private $state;

    public function getState()
    {
        return $this->state;
    }
    public function setState($state)
    {
        $this->state = $state;
    }
	
	/**
     * @ORM\Column(type="string")
     */
    private $title;


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

}