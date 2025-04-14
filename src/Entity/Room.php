<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'room', cascade: ['persist', 'remove'])]
    private ?resident $resident = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResident(): ?resident
    {
        return $this->resident;
    }

    public function setResident(?resident $resident): static
    {
        $this->resident = $resident;

        return $this;
    }
}
