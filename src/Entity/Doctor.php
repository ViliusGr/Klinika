<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DoctorRepository::class)
 */
class Doctor
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private $emplid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialty")
     * @ORM\JoinColumn(name="specialty_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $specialty;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Schedule", mappedBy="doctor")
     */
    private $schedule;


    public function getId(): ?string
    {
        return $this->emplid;
    }

    public function getEmplid(): ?string
    {
        return $this->emplid;
    }

    public function setEmplid(string $emplid): self
    {
        $this->emplid = $emplid;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getSpecialty()
    {
        return $this->specialty;
    }

    public function setSpecialty($specialty): void
    {
        $this->specialty = $specialty;
    }

    public function __toString(): ?string
    {
        return $this->user->getFullName();
    }
}
