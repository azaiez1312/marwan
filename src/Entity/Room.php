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

    #[ORM\OneToOne(mappedBy: 'room', cascade: ['persist', 'remove'])]
    private ?Resident $resident = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResident(): ?Resident
    {
        return $this->resident;
    }

    public function setResident(?Resident $resident): static
    {
        // unset the owning side of the relation if necessary
        if ($resident === null && $this->resident !== null) {
            $this->resident->setRoom(null);
        }

        // set the owning side of the relation if necessary
        if ($resident !== null && $resident->getRoom() !== $this) {
            $resident->setRoom($this);
        }

        $this->resident = $resident;

        return $this;
    }
}
