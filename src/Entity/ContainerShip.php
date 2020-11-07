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
    private $captain_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $container_limit;

    /**
     * ContainerShip constructor.
     * @param $id
     * @param $name
     * @param $captain_name
     * @param $container_limit
     */
    public function __construct($id, $name, $captain_name, $container_limit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->captain_name = $captain_name;
        $this->container_limit = $container_limit;
    }

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
        return $this->captain_name;
    }

    public function setCaptainName(string $captain_name): self
    {
        $this->captain_name = $captain_name;

        return $this;
    }

    public function getContainerLimit(): ?int
    {
        return $this->container_limit;
    }

    public function setContainerLimit(int $container_limit): self
    {
        $this->container_limit = $container_limit;

        return $this;
    }
}
