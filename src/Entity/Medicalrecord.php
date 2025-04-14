<?php

namespace App\Entity;

use App\Repository\MedicalrecordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalrecordRepository::class)]
class Medicalrecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'medicalrecord', cascade: ['persist', 'remove'])]
    private ?resident $resident = null;

    /**
     * @var Collection<int, Visite>
     */
    #[ORM\OneToMany(targetEntity: Visite::class, mappedBy: 'medicalrecord')]
    private Collection $visites;

    /**
     * @var Collection<int, Care>
     */
    #[ORM\OneToMany(targetEntity: Care::class, mappedBy: 'medicalrecord')]
    private Collection $cares;

    /**
     * @var Collection<int, Treatment>
     */
    #[ORM\OneToMany(targetEntity: Treatment::class, mappedBy: 'medicalrecord')]
    private Collection $treatments;

    public function __construct()
    {
        $this->visites = new ArrayCollection();
        $this->cares = new ArrayCollection();
        $this->treatments = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Visite>
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): static
    {
        if (!$this->visites->contains($visite)) {
            $this->visites->add($visite);
            $visite->setMedicalrecord($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): static
    {
        if ($this->visites->removeElement($visite)) {
            // set the owning side to null (unless already changed)
            if ($visite->getMedicalrecord() === $this) {
                $visite->setMedicalrecord(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Care>
     */
    public function getCares(): Collection
    {
        return $this->cares;
    }

    public function addCare(Care $care): static
    {
        if (!$this->cares->contains($care)) {
            $this->cares->add($care);
            $care->setMedicalrecord($this);
        }

        return $this;
    }

    public function removeCare(Care $care): static
    {
        if ($this->cares->removeElement($care)) {
            // set the owning side to null (unless already changed)
            if ($care->getMedicalrecord() === $this) {
                $care->setMedicalrecord(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Treatment>
     */
    public function getTreatments(): Collection
    {
        return $this->treatments;
    }

    public function addTreatment(Treatment $treatment): static
    {
        if (!$this->treatments->contains($treatment)) {
            $this->treatments->add($treatment);
            $treatment->setMedicalrecord($this);
        }

        return $this;
    }

    public function removeTreatment(Treatment $treatment): static
    {
        if ($this->treatments->removeElement($treatment)) {
            // set the owning side to null (unless already changed)
            if ($treatment->getMedicalrecord() === $this) {
                $treatment->setMedicalrecord(null);
            }
        }

        return $this;
    }
}
