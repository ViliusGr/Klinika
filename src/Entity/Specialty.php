<?php

namespace App\Entity;

use App\Repository\SpecialtyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SpecialtyRepository::class)
 */
class Specialty
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=6)
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subgroup;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
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

    public function getSubgroup(): ?string
    {
        return $this->subgroup;
    }

    public function setSubgroup(string $subgroup): self
    {
        $this->subgroup = $subgroup;

        return $this;
    }
}
