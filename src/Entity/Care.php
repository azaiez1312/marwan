<?php

namespace App\Entity;

use App\Repository\CareRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CareRepository::class)]
class Care
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cares')]
    private ?medicalrecord $medicalrecord = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $schedule = null;

    #[ORM\Column(length: 255)]
    private ?string $caregiver = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Notes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicalrecord(): ?medicalrecord
    {
        return $this->medicalrecord;
    }

    public function setMedicalrecord(?medicalrecord $medicalrecord): static
    {
        $this->medicalrecord = $medicalrecord;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTimeInterface $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getCaregiver(): ?string
    {
        return $this->caregiver;
    }

    public function setCaregiver(string $caregiver): static
    {
        $this->caregiver = $caregiver;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->Notes;
    }

    public function setNotes(string $Notes): static
    {
        $this->Notes = $Notes;

        return $this;
    }
}
