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
     * @ORM\Column(type="string", length=20)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=ContainerShip::class, inversedBy="containers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $containerShipId;

    /**
     * @ORM\ManyToOne(targetEntity=ContainerModel::class, inversedBy="containers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ContainerModelId;

    /**
     * @ORM\OneToMany(targetEntity=ContainerProduct::class, mappedBy="containerId")
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

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getContainerShipId(): ?ContainerShip
    {
        return $this->containerShipId;
    }

    public function setContainerShipId(?ContainerShip $containerShipId): self
    {
        $this->containerShipId = $containerShipId;

        return $this;
    }

    public function getContainerModelId(): ?ContainerModel
    {
        return $this->ContainerModelId;
    }

    public function setContainerModelId(?ContainerModel $ContainerModelId): self
    {
        $this->ContainerModelId = $ContainerModelId;

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
            $containerProduct->setContainerId($this);
        }

        return $this;
    }

    public function removeContainerProduct(ContainerProduct $containerProduct): self
    {
        if ($this->containerProducts->removeElement($containerProduct)) {
            // set the owning side to null (unless already changed)
            if ($containerProduct->getContainerId() === $this) {
                $containerProduct->setContainerId(null);
            }
        }

        return $this;
    }
}
