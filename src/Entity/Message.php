<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     max = 255
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *     max = 1024
     * )
     */
    private $text;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $sentAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
     */
    private $receiver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Doctor")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="emplid")
     */
    private $sender;

    public function __construct()
    {
        $this->sentAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getSentAt()
    {
        return $this->sentAt;
    }

    public function setSentAt($sentAt): void
    {
        $this->sentAt = $sentAt;
    }

    public function getSentAtString()
    {
        return $this->sentAt->format("Y-m-d H:i");
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function setReceiver($receiver): void
    {
        $this->receiver = $receiver;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setSender($sender): void
    {
        $this->sender = $sender;
    }


}
