<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource;
 * @ORM\Entity(repositoryClass="App\Repository\StatusJourneyRepository")
 */
class StatusJourney
{
    const CREATION = 1;
    const RESPONDED = 2;
    const ON_THE_WAY = 3;
    const DONE = 4;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("getAds")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("getAds")
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Journey", mappedBy="statusJourney")
     */
    private $journeys;

    public function __construct()
    {
        $this->journeys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|journey[]
     */
    public function getJourneys(): Collection
    {
        return $this->journeys;
    }

    public function addJourney(journey $journey): self
    {
        if (!$this->journeys->contains($journey)) {
            $this->journeys[] = $journey;
            $journey->setStatusJourney($this);
        }

        return $this;
    }

    public function removeJourney(journey $journey): self
    {
        if ($this->journeys->contains($journey)) {
            $this->journeys->removeElement($journey);
            // set the owning side to null (unless already changed)
            if ($journey->getStatusJourney() === $this) {
                $journey->setStatusJourney(null);
            }
        }

        return $this;
    }
}
