<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\AdGradeRepository")
 */
class AdGrade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="adGrades")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("getAds")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ad", inversedBy="adGrades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ad;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("getAds")
     */
    private $grade;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("getAds")
     */
    private $gradedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?customer
    {
        return $this->customer;
    }

    public function setCustomer(?customer $customer): self
    {
        $this->customer = $customer;

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

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getGradedAt(): ?\DateTimeInterface
    {
        return $this->gradedAt;
    }

    public function setGradedAt(\DateTimeInterface $gradedAt): self
    {
        $this->gradedAt = $gradedAt;

        return $this;
    }
}
