<?php

namespace App\Entity;

use App\Repository\ResidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResidentRepository::class)]
class Resident extends Person
{
    /**
     * @var Collection<int, Activity>
     */
    #[ORM\ManyToMany(targetEntity: Activity::class, mappedBy: 'residents')]
    private Collection $activities;

    /**
     * @var Collection<int, Billing>
     */
    #[ORM\OneToMany(targetEntity: Billing::class, mappedBy: 'resident', cascade: ['persist', 'remove'])]
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

    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->addResident($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            $activity->removeResident($this);
        }

        return $this;
    }

    public function getBillings(): Collection
    {
        return $this->billings;
    }

    public function addBilling(Billing $billing): self
    {
        if (!$this->billings->contains($billing)) {
            $this->billings->add($billing);
            $billing->setResident($this);
        }

        return $this;
    }

    public function removeBilling(Billing $billing): self
    {
        if ($this->billings->removeElement($billing)) {
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

    public function setRoom(?Room $room): self
    {
        if ($room === null && $this->room !== null) {
            $this->room->setResident(null);
        }

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

    public function setMedicalrecord(?Medicalrecord $medicalrecord): self
    {
        if ($medicalrecord === null && $this->medicalrecord !== null) {
            $this->medicalrecord->setResident(null);
        }

        if ($medicalrecord !== null && $medicalrecord->getResident() !== $this) {
            $medicalrecord->setResident($this);
        }

        $this->medicalrecord = $medicalrecord;

        return $this;
    }
}
