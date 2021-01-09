<?php

namespace App\Entity;

use App\Repository\ContainerShipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=Container::class, mappedBy="containerShipId")
     */
    private $containers;

    public function __construct()
    {
        $this->containers = new ArrayCollection();
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

    /**
     * @return Collection|Container[]
     */
    public function getContainers(): Collection
    {
        return $this->containers;
    }

    public function addContainer(Container $container): self
    {
        if (!$this->containers->contains($container)) {
            $this->containers[] = $container;
            $container->setContainerShipId($this);
        }

        return $this;
    }

    public function removeContainer(Container $container): self
    {
        if ($this->containers->removeElement($container)) {
            // set the owning side to null (unless already changed)
            if ($container->getContainerShipId() === $this) {
                $container->setContainerShipId(null);
            }
        }

        return $this;
    }
}
