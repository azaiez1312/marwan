<?php

namespace App\Entity;

use App\Repository\CareRepository;
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
}
