<?php

namespace App\Entity;

use App\Repository\ContainerShipRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerShipRepository::class)
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
    private $CaptainName;

    /**
     * @ORM\Column(type="integer")
     */
    private $ContainerLimit;

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
        return $this->CaptainName;
    }

    public function setCaptainName(string $CaptainName): self
    {
        $this->CaptainName = $CaptainName;

        return $this;
    }

    public function getContainerLimit(): ?int
    {
        return $this->ContainerLimit;
    }

    public function setContainerLimit(int $ContainerLimit): self
    {
        $this->ContainerLimit = $ContainerLimit;

        return $this;
    }
}
