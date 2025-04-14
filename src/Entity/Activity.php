<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, resident>
     */
    #[ORM\ManyToMany(targetEntity: resident::class, inversedBy: 'activities')]
    private Collection $resident;

    public function __construct()
    {
        $this->resident = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, resident>
     */
    public function getResident(): Collection
    {
        return $this->resident;
    }

    public function addResident(resident $resident): static
    {
        if (!$this->resident->contains($resident)) {
            $this->resident->add($resident);
        }

        return $this;
    }

    public function removeResident(resident $resident): static
    {
        $this->resident->removeElement($resident);

        return $this;
    }
}
