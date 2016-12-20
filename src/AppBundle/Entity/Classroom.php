<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;

/**
 * @ORM\Entity
 */
class Classroom
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Session", mappedBy="classroom", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $sessions;
	
	public function __toString()
	{
		return (string) $this->getLabel();
	}

}