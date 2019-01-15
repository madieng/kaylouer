<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testDriver;

    public function getTestDriver(): ?string
    {
        return $this->testDriver;
    }

    public function setTestDriver(string $testDriver): self
    {
        $this->testDriver = $testDriver;

        return $this;
    }
}
