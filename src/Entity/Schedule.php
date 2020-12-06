<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Doctor", inversedBy="schedule")
     * @ORM\JoinColumn(name="doctor_emplid", referencedColumnName="emplid")
     * @Assert\NotBlank()
     */
    private $doctor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DaySchedule", mappedBy="schedule")
     */
    private $days;


    public function __construct()
    {
        $this->days = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDoctor()
    {
        return $this->doctor;
    }

    public function setDoctor($doctor): void
    {
        $this->doctor = $doctor;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setDays($days): void
    {
        $this->days = $days;
    }

}
