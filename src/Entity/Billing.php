<?php

namespace App\Entity;

use App\Repository\BillingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillingRepository::class)]
class Billing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'billings')]
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
