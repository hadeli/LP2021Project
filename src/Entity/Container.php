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
     * @ORM\ManyToOne(targetEntity=ContainerModel::class, inversedBy="containers")
     */
    private $container_model;

    /**
     * @ORM\ManyToOne(targetEntity=Containership::class, inversedBy="containers")
     */
    private $containership;

    /**
     * @ORM\OneToMany(targetEntity=ContainerProduct::class, mappedBy="container")
     */
    private $containerProducts;

    public function __construct()
    {
        $this->containerProducts = new ArrayCollection();
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

    public function getContainerModel(): ?ContainerModel
    {
        return $this->container_model;
    }

    public function setContainerModel(?ContainerModel $container_model): self
    {
        $this->container_model = $container_model;

        return $this;
    }

    public function getContainership(): ?Containership
    {
        return $this->containership;
    }

    public function setContainership(?Containership $containership): self
    {
        $this->containership = $containership;

        return $this;
    }

    /**
     * @return Collection|ContainerProduct[]
     */
    public function getContainerProducts(): Collection
    {
        return $this->containerProducts;
    }

    public function addContainerProduct(ContainerProduct $containerProduct): self
    {
        if (!$this->containerProducts->contains($containerProduct)) {
            $this->containerProducts[] = $containerProduct;
            $containerProduct->setContainer($this);
        }

        return $this;
    }

    public function removeContainerProduct(ContainerProduct $containerProduct): self
    {
        if ($this->containerProducts->removeElement($containerProduct)) {
            // set the owning side to null (unless already changed)
            if ($containerProduct->getContainer() === $this) {
                $containerProduct->setContainer(null);
            }
        }

        return $this;
    }
}
