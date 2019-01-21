<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $road;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zip;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Journey", mappedBy="arrivalAdress")
     */
    private $arrivalJourneys;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Journey", mappedBy="arrivalAddress")
     */
    private $departureJourneys;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Town", inversedBy="address")
     * @ORM\JoinColumn(nullable=false)
     */
    private $town;

    public function __construct()
    {
        $this->arrivalJourneys = new ArrayCollection();
        $this->departureJourneys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoad(): ?string
    {
        return $this->road;
    }

    public function setRoad(string $road): self
    {
        $this->road = $road;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return Collection|journey[]
     */
    public function getArrivalJourneys(): Collection
    {
        return $this->arrivalJourneys;
    }

    public function addArrivalJourney(journey $arrivalJourney): self
    {
        if (!$this->arrivalJourneys->contains($arrivalJourney)) {
            $this->arrivalJourneys[] = $arrivalJourney;
            $arrivalJourney->setArrivalAdress($this);
        }

        return $this;
    }

    public function removeArrivalJourney(journey $arrivalJourney): self
    {
        if ($this->arrivalJourneys->contains($arrivalJourney)) {
            $this->arrivalJourneys->removeElement($arrivalJourney);
            // set the owning side to null (unless already changed)
            if ($arrivalJourney->getArrivalAdress() === $this) {
                $arrivalJourney->setArrivalAdress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|journey[]
     */
    public function getDepartureJourneys(): Collection
    {
        return $this->departureJourneys;
    }

    public function addDepartureJourney(journey $departureJourney): self
    {
        if (!$this->departureJourneys->contains($departureJourney)) {
            $this->departureJourneys[] = $departureJourney;
            $departureJourney->setArrivalAddress($this);
        }

        return $this;
    }

    public function removeDepartureJourney(journey $departureJourney): self
    {
        if ($this->departureJourneys->contains($departureJourney)) {
            $this->departureJourneys->removeElement($departureJourney);
            // set the owning side to null (unless already changed)
            if ($departureJourney->getArrivalAddress() === $this) {
                $departureJourney->setArrivalAddress(null);
            }
        }

        return $this;
    }

    public function getTown(): ?Town
    {
        return $this->town;
    }

    public function setTown(?Town $town): self
    {
        $this->town = $town;

        return $this;
    }
}
