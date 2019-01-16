<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer extends User
{

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AdGrade", mappedBy="customer")
     */
    private $adGrades;

    public function __construct()
    {
        $this->adGrades = new ArrayCollection();
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
            $adGrade->setCustomer($this);
        }

        return $this;
    }

    public function removeAdGrade(AdGrade $adGrade): self
    {
        if ($this->adGrades->contains($adGrade)) {
            $this->adGrades->removeElement($adGrade);
            // set the owning side to null (unless already changed)
            if ($adGrade->getCustomer() === $this) {
                $adGrade->setCustomer(null);
            }
        }

        return $this;
    }
}
