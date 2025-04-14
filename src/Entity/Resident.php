<?php

namespace App\Entity;

use App\Repository\ResidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResidentRepository::class)]
class Resident
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Activity>
     */
    #[ORM\ManyToMany(targetEntity: Activity::class, mappedBy: 'resident')]
    private Collection $activities;

    /**
     * @var Collection<int, Billing>
     */
    #[ORM\OneToMany(targetEntity: Billing::class, mappedBy: 'resident')]
    private Collection $billings;

    #[ORM\OneToOne(mappedBy: 'resident', cascade: ['persist', 'remove'])]
    private ?Room $room = null;

    #[ORM\OneToOne(mappedBy: 'resident', cascade: ['persist', 'remove'])]
    private ?Medicalrecord $medicalrecord = null;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->billings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): static
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->addResident($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): static
    {
        if ($this->activities->removeElement($activity)) {
            $activity->removeResident($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Billing>
     */
    public function getBillings(): Collection
    {
        return $this->billings;
    }

    public function addBilling(Billing $billing): static
    {
        if (!$this->billings->contains($billing)) {
            $this->billings->add($billing);
            $billing->setResident($this);
        }

        return $this;
    }

    public function removeBilling(Billing $billing): static
    {
        if ($this->billings->removeElement($billing)) {
            // set the owning side to null (unless already changed)
            if ($billing->getResident() === $this) {
                $billing->setResident(null);
            }
        }

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        // unset the owning side of the relation if necessary
        if ($room === null && $this->room !== null) {
            $this->room->setResident(null);
        }

        // set the owning side of the relation if necessary
        if ($room !== null && $room->getResident() !== $this) {
            $room->setResident($this);
        }

        $this->room = $room;

        return $this;
    }

    public function getMedicalrecord(): ?Medicalrecord
    {
        return $this->medicalrecord;
    }

    public function setMedicalrecord(?Medicalrecord $medicalrecord): static
    {
        // unset the owning side of the relation if necessary
        if ($medicalrecord === null && $this->medicalrecord !== null) {
            $this->medicalrecord->setResident(null);
        }

        // set the owning side of the relation if necessary
        if ($medicalrecord !== null && $medicalrecord->getResident() !== $this) {
            $medicalrecord->setResident($this);
        }

        $this->medicalrecord = $medicalrecord;

        return $this;
    }
}
