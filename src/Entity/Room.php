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

    #[ORM\Column(length: 10)]
    private ?string $room_number = null;

    #[ORM\Column]
    private ?int $floor = null;

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

    public function getRoomNumber(): ?string
    {
        return $this->room_number;
    }

    public function setRoomNumber(string $room_number): static
    {
        $this->room_number = $room_number;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): static
    {
        $this->floor = $floor;

        return $this;
    }
}
