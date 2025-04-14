<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicamentRepository::class)]
class Medicament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'medicaments')]
    private ?treatment $treatment = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $dosage_quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $dosage_unit = null;

    #[ORM\Column(length: 255)]
    private ?string $frequency = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instructions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTreatment(): ?treatment
    {
        return $this->treatment;
    }

    public function setTreatment(?treatment $treatment): static
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDosageQuantity(): ?float
    {
        return $this->dosage_quantity;
    }

    public function setDosageQuantity(float $dosage_quantity): static
    {
        $this->dosage_quantity = $dosage_quantity;

        return $this;
    }

    public function getDosageUnit(): ?string
    {
        return $this->dosage_unit;
    }

    public function setDosageUnit(string $dosage_unit): static
    {
        $this->dosage_unit = $dosage_unit;

        return $this;
    }

    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    public function setFrequency(string $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(?string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }
}
