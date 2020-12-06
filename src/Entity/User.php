<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Assert\Length(
     *     min = 8
     * )
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUsername()
    {
        return $this->email;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->name . " " . $this->surname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getRoles(){
        return $this->roles;
    }

    public function addRole($role){
        $this->roles[] = $role;
    }

    public function getSalt(){}
    public function eraseCredentials(){}

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->name,
            $this->surname,
            $this->email,
            $this->password
        ]);
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->surname,
            $this->email,
            $this->password
            ) = unserialize($serialized, ['allower_classes' => false]);
    }
}
