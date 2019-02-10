<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"          
 *      },
 *      itemOperations={
 *          "get",
 *          "driver"={"method"="GET", "path"="/drivers-data/{id}", "normalization_context"={"groups"={"driver"}}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver extends User
{

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vehicle", mappedBy="driver")
     * @Groups("driver")
     */
    private $vehicles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ad", mappedBy="driver")
     */
    private $respondedAds;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Journey", mappedBy="drivers")
     * @Groups("driver")
     */
    private $journeys;

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
        $this->respondedAds = new ArrayCollection();
        $this->journeys = new ArrayCollection();
    }

    /**
     * @return Collection|Vehicle[]
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->addDriver($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        if ($this->vehicles->contains($vehicle)) {
            $this->vehicles->removeElement($vehicle);
            $vehicle->removeDriver($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ad[]
     */
    public function getRespondedAds(): Collection
    {
        return $this->respondedAds;
    }

    public function addRespondedAd(Ad $respondedAd): self
    {
        if (!$this->respondedAds->contains($respondedAd)) {
            $this->respondedAds[] = $respondedAd;
            $respondedAd->setDriver($this);
        }

        return $this;
    }

    public function removeRespondedAd(Ad $respondedAd): self
    {
        if ($this->respondedAds->contains($respondedAd)) {
            $this->respondedAds->removeElement($respondedAd);
            // set the owning side to null (unless already changed)
            if ($respondedAd->getDriver() === $this) {
                $respondedAd->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Journey[]
     */
    public function getJourneys(): Collection
    {
        return $this->journeys;
    }

    public function addJourney(Journey $journey): self
    {
        if (!$this->journeys->contains($journey)) {
            $this->journeys[] = $journey;
            $journey->addDriver($this);
        }

        return $this;
    }

    public function removeJourney(Journey $journey): self
    {
        if ($this->journeys->contains($journey)) {
            $this->journeys->removeElement($journey);
            $journey->removeDriver($this);
        }

        return $this;
    }
}
