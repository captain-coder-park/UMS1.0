<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ureferences
 *
 * @ORM\Table(name="Ureferences")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UreferencesRepository")
 */
class Ureferences
{
    
     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $fullName;

    /** @ORM\Column(type="integer") */
    private $phone;

    /** @ORM\Column(type="string") */
    private $email;

    /** @ORM\Column(type="string") */
    private $city;

     /** @ORM\Column(type="integer") */
     private $rid;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="rid", referencedColumnName="id", nullable=false)
     */
    private $user;

    public function getUser()
    {
    return $this->user;
    }

    public function setUser(User $user)
    {
    $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getRid()
    {
        return $this->rid;
    }

    public function setRid($rid)
    {
        $this->rid = $rid;
    }
}

