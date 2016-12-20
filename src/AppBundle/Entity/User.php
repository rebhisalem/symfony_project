<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="userType", type="string")
 * @DiscriminatorMap({"user" = "User", "admin" = "Admin", "teacher" = "Teacher", "student" = "Student", "responsable" = "Responsable"})
 *
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = array();

    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles()
    {
        $roles = $this->roles;

        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'Student';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     */
    public function getSalt()
    {
        // See "Do you need to use a Salt?" at http://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return;
    }

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
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
	
}

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class Admin extends User
{
    
}

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class Responsable extends User
{
    
}

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class Student extends User
{
	
	/**
     * @ORM\Column(type="string")
     */
	private $CIN;
	
    public function getCIN()
    {
        return $this->CIN;
    }
    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $birthdate;
	
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $birthplace;
	
    public function getBirthplace()
    {
        return $this->birthplace;
    }
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $address;
	
    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $postcode;
	
    public function getPostcode()
    {
        return $this->postcode;
    }
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $city;
	
    public function getCity()
    {
        return $this->city;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $gsm;
	
    public function getGSM()
    {
        return $this->gsm;
    }
    public function setGSM($gsm)
    {
        $this->gsm = $gsm;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $bac_section;
	
    public function getbac_section()
    {
        return $this->bac_section;
    }
    public function setbac_section($bac_section)
    {
        $this->bac_section = $bac_section;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $bac_grade;
	
    public function getbac_grade()
    {
        return $this->bac_grade;
    }
    public function setbac_grade($bac_grade)
    {
        $this->bac_grade = $bac_grade;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $bac_year;
	
    public function getbac_year()
    {
        return $this->bac_year;
    }
    public function setbac_year($bac_year)
    {
        $this->bac_year = $bac_year;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $inscriptionNbr;
	
    public function getinscriptionNbr()
    {
        return $this->inscriptionNbr;
    }
    public function setinscriptionNbr($inscriptionNbr)
    {
        $this->inscriptionNbr = $inscriptionNbr;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $inscriptionYear;
	
    public function getinscriptionYear()
    {
        return $this->inscriptionYear;
    }
    public function setinscriptionYear($inscriptionYear)
    {
        $this->inscriptionYear = $inscriptionYear;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $otherDegree;
	
    public function getotherDegree()
    {
        return $this->otherDegree;
    }
    public function setotherDegree($otherDegree)
    {
        $this->otherDegree = $otherDegree;
    }
	
	/**
     * @ORM\Column(type="string")
     */
	private $otherDegreeYear;
	
    public function getotherDegreeYear()
    {
        return $this->otherDegreeYear;
    }
    public function setotherDegreeYear($otherDegreeYear)
    {
        $this->otherDegreeYear = $otherDegreeYear;
    }
	
	/**
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
	private $affected;
	
    public function getAffected()
    {
        return $this->affected;
    }
    public function setAffected($affected)
    {
        $this->affected = $affected;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Section", inversedBy="students", cascade={"persist"})
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
	
	public function __toString()
	{
		return (string) $this->getFirstname()." ".$this->getLastname() ;
	}
	
	/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subject", mappedBy="student", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $subjects;
	 
	 /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soutenance", mappedBy="student", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $soutenances;
}

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */

class Teacher extends User
{
	
	/**
     * @ORM\Column(type="string")
     */
	private $grade;
	
    public function getGrade()
    {
        return $this->grade;
    }
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }
	
	/**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Department", inversedBy="teachers", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
   */
   private $department;
	
    public function getDepartment()
    {
        return $this->department;
    }
    public function setDepartment($department)
    {
        $this->department = $department;
    }
	
	public function __toString()
	{
		return (string) $this->getFirstname()." ".$this->getLastname() ;
	}
	
		/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subject", mappedBy="teacher", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $subjects;
	 
	 /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soutenance", mappedBy="teacher", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $soutenances_encadrant;
	 /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Soutenance", mappedBy="teacher", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $soutenances_examinateur;
	 
	 /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Session", mappedBy="teacher", cascade={"remove"}, orphanRemoval=true)
     */
	 protected $sessions;
}