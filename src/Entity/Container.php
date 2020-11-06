<?php

namespace App\Entity;

use App\Repository\ContainerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerRepository::class)
 */
class Container
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=container::class)
     */
    private $container_model;

    /**
     * @ORM\ManyToOne(targetEntity=containership::class, inversedBy="containers")
     */
    private $containership;

    /**
     * @ORM\OneToMany(targetEntity=Containerproduct::class, mappedBy="container")
     */
    private $containerproducts;

    public function __construct()
    {
        $this->containerproducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getContainerModel(): ?container
    {
        return $this->container_model;
    }

    public function setContainerModel(?container $container_model): self
    {
        $this->container_model = $container_model;

        return $this;
    }

    public function getContainership(): ?containership
    {
        return $this->containership;
    }

    public function setContainership(?containership $containership): self
    {
        $this->containership = $containership;

        return $this;
    }

    /**
     * @return Collection|Containerproduct[]
     */
    public function getContainerproducts(): Collection
    {
        return $this->containerproducts;
    }

    public function addContainerproduct(Containerproduct $containerproduct): self
    {
        if (!$this->containerproducts->contains($containerproduct)) {
            $this->containerproducts[] = $containerproduct;
            $containerproduct->setContainer($this);
        }

        return $this;
    }

    public function removeContainerproduct(Containerproduct $containerproduct): self
    {
        if ($this->containerproducts->removeElement($containerproduct)) {
            // set the owning side to null (unless already changed)
            if ($containerproduct->getContainer() === $this) {
                $containerproduct->setContainer(null);
            }
        }

        return $this;
    }
}
