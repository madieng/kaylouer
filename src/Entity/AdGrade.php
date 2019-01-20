<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\ManyToOne(targetEntity="App\Entity\customer", inversedBy="adGrades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ad", inversedBy="adGrades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ad;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $grade;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
