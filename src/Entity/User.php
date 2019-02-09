<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;


//todo : map to database ... this is a User entity
//todo : here the column , will be the column in database
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email",message="This email is already in use")
 * @UniqueEntity(fields="name",message="the name is already in use")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=123,unique=true) //here no need to include unique for username
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true) //here unique can be included
     */
    private $dateofbirth;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainpassword;

    /**
     * @ORM\Column(type="string",length=123)
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserPreferences",cascade={"persist"})
     */
    private $preferences;


    /**
     * @param mixed $preferences
     */
    public function setPreferences($preferences): void
    {
        $this->preferences = $preferences;
    }

    /**
     * @return UserPreferences|null
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    public function eraseCredentials()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getPassword()
   {
       return $this->password;
   }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainpassword;
    }

    /**
     * @param mixed $plainpassword
     */
    public function setPlainPassword($plainpassword)
    {
        $this->plainpassword = $plainpassword;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

    }

    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }

    public function getSalt()
    {
        return null;
    }

}
