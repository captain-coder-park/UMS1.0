<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements UserInterface, \Serializable
{
        /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $email;


    /** @ORM\Column(type="string") */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $status = 1; // default 1 (active)

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->salt = base64_encode(random_bytes(30));
        $this->roles = ['ROLE_USER'];
        $this->status = true;
        $this->createdAt = new \DateTime(); // sets to now
    }

    // Generate getter and setter methods below
    public function getUsername() {
        return $this->username;
    }

    // Getter
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this; // allow method chaining
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
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

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    // existing methods (getUsername, getPassword, getRoles, etc.)

    public function getSalt() {
        return null; // bcrypt/argon2i don't need salt separately
    }

    public function eraseCredentials() { }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }


    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            // add other fields if needed (example: email)
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            // must match order in serialize()
        ) = unserialize($serialized);
    }
}
