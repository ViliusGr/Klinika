<?php

namespace App\Entity;

use App\Repository\DayScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DayScheduleRepository::class)
 */
class DaySchedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $timeFrom;

    /**
     * @ORM\Column(type="time")
     */
    private $timeTo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Schedule", inversedBy="days")
     */
    private $schedule;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DayOfWeek")
     */
    private $dayOfWeek;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    public function setTimeFrom($timeFrom): self
    {
        $this->timeFrom = $timeFrom;

        return $this;
    }

    public function getTimeTo()
    {
        return $this->timeTo;
    }

    public function setTimeTo($timeTo): self
    {
        $this->timeTo = $timeTo;

        return $this;
    }

    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek($dayOfWeek): void
    {
        $this->dayOfWeek = $dayOfWeek;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setSchedule($schedule): void
    {
        $this->schedule = $schedule;
    }
}
