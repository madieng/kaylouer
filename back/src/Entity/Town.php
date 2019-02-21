<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\TownRepository")
 */
class Town
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"getAds", "driver"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"getAds", "driver"})
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="town")
     */
    private $address;

    public function __construct()
    {
        $this->address = new ArrayCollection();
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
     * @return Collection|address[]
     */
    public function getAddress(): Collection
    {
        return $this->address;
    }

    public function addAddress(address $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setTown($this);
        }

        return $this;
    }

    public function removeAddress(address $address): self
    {
        if ($this->address->contains($address)) {
            $this->address->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getTown() === $this) {
                $address->setTown(null);
            }
        }

        return $this;
    }
}
