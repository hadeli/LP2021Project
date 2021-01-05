<?php

namespace App\Entity;

use App\Repository\ContainerShipRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerShipRepository::class)
 * @ORM\Table(name="CONTAINERSHIP")
 */
class ContainerShip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $captainName;

    /**
     * @ORM\Column(type="integer")
     */
    private $containerLimit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCaptainName(): ?string
    {
        return $this->captainName;
    }

    public function setCaptainName(string $captainName): self
    {
        $this->captainName = $captainName;

        return $this;
    }

    public function getContainerLimit(): ?int
    {
        return $this->containerLimit;
    }

    public function setContainerLimit(int $containerLimit): self
    {
        $this->containerLimit = $containerLimit;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}