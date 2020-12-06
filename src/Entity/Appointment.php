<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;


    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *     max = 1024
     * )
     */
    private $info;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="emplid")
     */
    private $doctor;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getTimeString(): ?string
    {
        return $this->time->format('H:i');
    }

    public function setTime($time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getPatient()
    {
        return $this->patient;
    }

    public function setPatient($patient): void
    {
        $this->patient = $patient;
    }

    public function getDoctor()
    {
        return $this->doctor;
    }

    public function setDoctor($doctor): void
    {
        $this->doctor = $doctor;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getDateString(): ?string
    {
        return $this->date->format('Y-m-d');
    }
}
