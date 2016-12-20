<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class Department
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
    private $label;

    public function getLabel()
    {
        return $this->label;
    }
    public function setLabel($label)
    {
        $this->label = $label;
    }
	
	/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Teacher", mappedBy="department", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $teachers;
	
	public function __toString()
	{
		return (string) $this->getLabel();
	}

}