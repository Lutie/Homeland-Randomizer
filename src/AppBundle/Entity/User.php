<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 * @UniqueEntity(fields={"email"}, errorPath="email")
 * @UniqueEntity(fields={"login"}, errorPath="login")
 */
class User implements UserInterface
{

    use IdTrait;

    /**
     * @ORM\Column(unique=true, type="string", length=128)
     * @Assert\NotNull()
     * @Assert\Length(max=128)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotNull()
     * @Assert\Length(max=128)
     */
    private $username;

    /**
     * @ORM\Column(unique=true)
     * @Assert\NotNull()
     * @Assert\Email(checkHost=true)
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $email;

    /**
     * @ORM\Column()
     */
    private $password;

    /**
     * @ORM\Column(
     *     type="date",
     * )
     * @Assert\NotNull()
     * @Assert\Date()
     */
    private $date;

    /**
     * @ORM\Column()
     */
    private $locale = "fr";

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type("bool")
     */
    private $isAdmin = false;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type("bool")
     */
    private $isGM = false;

    /**
     * @ORM\OneToMany(targetEntity="Character", mappedBy="author")
     */
    private $characters;

    /**
     * @Assert\Type("string")
     * @Assert\Length(min=6)
     */
    private $rawPassword;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->characters = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->getUsername();
    }

    public function getRoles()
    {

        $roles = ['ROLE_USER'];

        if ($this->getIsAdmin()) {
            $roles[] = 'ROLE_ADMIN';
        }

        if ($this->getIsGM()) {
            $roles[] = 'ROLE_GAMEMASTER';
        }

        return $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        $this->rawPassword = null;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function getRawPassword()
    {
        return $this->rawPassword;
    }

    public function setRawPassword($rawPassword)
    {
        $this->rawPassword = $rawPassword;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getIsGM()
    {
        return $this->isGM;
    }

    public function setIsGM($isGM)
    {
        $this->isGM = $isGM;
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    public function removeCharacters(Character $characters)
    {
        if ($this->characters->contains($characters)) {
            $this->characters->removeElement($characters);
        }
        return $this;
    }

    public function addCharacters(Character $characters)
    {
        if (!$this->characters->contains($characters)) {
            $this->characters->add($characters);
        }
        return $this;
    }

}