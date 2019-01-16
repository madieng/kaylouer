<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JourneyRepository")
 */
class Journey
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\driver", inversedBy="journeys")
     */
    private $drivers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ad", inversedBy="journeys")
     */
    private $ad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StatusJourney", inversedBy="journeys")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statusJourney;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="arrivalJourneys")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arrivalAdress;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="departureJourneys")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arrivalAddress;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
        $this->departureAddress = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|driver[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(driver $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
        }

        return $this;
    }

    public function removeDriver(driver $driver): self
    {
        if ($this->drivers->contains($driver)) {
            $this->drivers->removeElement($driver);
        }

        return $this;
    }

    public function getAd(): ?ad
    {
        return $this->ad;
    }

    public function setAd(?ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getStatusJourney(): ?StatusJourney
    {
        return $this->statusJourney;
    }

    public function setStatusJourney(?StatusJourney $statusJourney): self
    {
        $this->statusJourney = $statusJourney;

        return $this;
    }

    public function getArrivalAdress(): ?Address
    {
        return $this->arrivalAdress;
    }

    public function setArrivalAdress(?Address $arrivalAdress): self
    {
        $this->arrivalAdress = $arrivalAdress;

        return $this;
    }

    public function getArrivalAddress(): ?Address
    {
        return $this->arrivalAddress;
    }

    public function setArrivalAddress(?Address $arrivalAddress): self
    {
        $this->arrivalAddress = $arrivalAddress;

        return $this;
    }
}
