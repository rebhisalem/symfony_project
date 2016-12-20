<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class Company
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
	private $name;
	
    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name = $name;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $address;
	
    public function getaddress()
    {
        return $this->address;
    }
    public function setaddress($address)
    {
        $this->address = $address;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $postcode;
	
    public function getpostcode()
    {
        return $this->postcode;
    }
    public function setpostcode($postcode)
    {
        $this->postcode = $postcode;
    }

	/**
     * @ORM\Column(type="string")
     */
	private $country;
	
    public function getcountry()
    {
        return $this->country;
    }
    public function setcountry($country)
    {
        $this->country = $country;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $phone;
	
    public function getphone()
    {
        return $this->phone;
    }
    public function setphone($phone)
    {
        $this->phone = $phone;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $fax;
	
    public function getfax()
    {
        return $this->fax;
    }
    public function setfax($fax)
    {
        $this->fax = $fax;
    }
	
	/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subject", mappedBy="company", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $subjects;
	 
	 /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soutenance", mappedBy="company", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $soutenances;
	
	public function __toString()
	{
		return (string) $this->getname() ;
	}
	
}