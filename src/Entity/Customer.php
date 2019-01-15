<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testCustomer;

    public function getTestCustomer(): ?string
    {
        return $this->testCustomer;
    }

    public function setTestCustomer(string $testCustomer): self
    {
        $this->testCustomer = $testCustomer;

        return $this;
    }
}
