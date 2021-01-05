<?php

namespace App\Entity;

use App\Repository\ContainershipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContainershipRepository::class)
 * @ORM\Table(name="CONTAINERSHIP")
 */
class Containership
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
     * @Assert\Type(type="alpha", message="{{ value }} ne pas être un nom de capitaine")
     */
    private $captainName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(max="1000", maxMessage="Un porte-conteneurs ne peut pas excéder 1000 conteneurs")
     */
    private $containerLimit;

    /**
     * @ORM\OneToMany(targetEntity=Container::class, mappedBy="containershipId")
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
            $container->setContainership($this);
        }

        return $this;
    }

    public function removeContainer(Container $container): self
    {
        if ($this->containers->removeElement($container)) {
            // set the owning side to null (unless already changed)
            if ($container->getContainership() === $this) {
                $container->setContainership(null);
            }
        }

        return $this;
    }
}
