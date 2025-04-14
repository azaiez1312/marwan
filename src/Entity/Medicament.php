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
}
