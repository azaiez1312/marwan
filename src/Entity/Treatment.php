<?php

namespace App\Entity;

use App\Repository\TreatmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreatmentRepository::class)]
class Treatment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'treatments')]
    private ?medicalrecord $medicalrecord = null;

    /**
     * @var Collection<int, Medicament>
     */
    #[ORM\OneToMany(targetEntity: Medicament::class, mappedBy: 'treatment')]
    private Collection $medicaments;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $schedule = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $caregiver = null;

    public function __construct()
    {
        $this->medicaments = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Medicament>
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): static
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments->add($medicament);
            $medicament->setTreatment($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): static
    {
        if ($this->medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getTreatment() === $this) {
                $medicament->setTreatment(null);
            }
        }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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
}
