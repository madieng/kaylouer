<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 */
class Ad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdGrade", mappedBy="ad")
     */
    private $adGrades;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdComment", mappedBy="ad")
     */
    private $adComments;

    /**
     * @ORM\Column(type="datetime")
     */
    private $appointmentAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $appointmentAdress;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\driver", inversedBy="respondedAds")
     */
    private $driver;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Journey", mappedBy="ad")
     */
    private $journeys;

    public function __construct()
    {
        $this->adGrades = new ArrayCollection();
        $this->adComments = new ArrayCollection();
        $this->journeys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|AdGrade[]
     */
    public function getAdGrades(): Collection
    {
        return $this->adGrades;
    }

    public function addAdGrade(AdGrade $adGrade): self
    {
        if (!$this->adGrades->contains($adGrade)) {
            $this->adGrades[] = $adGrade;
            $adGrade->setAd($this);
        }

        return $this;
    }

    public function removeAdGrade(AdGrade $adGrade): self
    {
        if ($this->adGrades->contains($adGrade)) {
            $this->adGrades->removeElement($adGrade);
            // set the owning side to null (unless already changed)
            if ($adGrade->getAd() === $this) {
                $adGrade->setAd(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AdComment[]
     */
    public function getAdComments(): Collection
    {
        return $this->adComments;
    }

    public function addAdComment(AdComment $adComment): self
    {
        if (!$this->adComments->contains($adComment)) {
            $this->adComments[] = $adComment;
            $adComment->setAd($this);
        }

        return $this;
    }

    public function removeAdComment(AdComment $adComment): self
    {
        if ($this->adComments->contains($adComment)) {
            $this->adComments->removeElement($adComment);
            // set the owning side to null (unless already changed)
            if ($adComment->getAd() === $this) {
                $adComment->setAd(null);
            }
        }

        return $this;
    }

    public function getAppointmentAt(): ?\DateTimeInterface
    {
        return $this->appointmentAt;
    }

    public function setAppointmentAt(\DateTimeInterface $appointmentAt): self
    {
        $this->appointmentAt = $appointmentAt;

        return $this;
    }

    public function getAppointmentAdress(): ?string
    {
        return $this->appointmentAdress;
    }

    public function setAppointmentAdress(string $appointmentAdress): self
    {
        $this->appointmentAdress = $appointmentAdress;

        return $this;
    }

    public function getDriver(): ?driver
    {
        return $this->driver;
    }

    public function setDriver(?driver $driver): self
    {
        $this->driver = $driver;

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
            $journey->setAd($this);
        }

        return $this;
    }

    public function removeJourney(Journey $journey): self
    {
        if ($this->journeys->contains($journey)) {
            $this->journeys->removeElement($journey);
            // set the owning side to null (unless already changed)
            if ($journey->getAd() === $this) {
                $journey->setAd(null);
            }
        }

        return $this;
    }
}
