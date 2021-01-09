<?php

namespace App\Entity;

use App\Repository\ContainerProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerProductRepository::class)
 */
class ContainerProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Container::class, inversedBy="containerProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $containerId;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="containerProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ProductId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContainerId(): ?Container
    {
        return $this->containerId;
    }

    public function setContainerId(?Container $containerId): self
    {
        $this->containerId = $containerId;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->ProductId;
    }

    public function setProductId(?Product $ProductId): self
    {
        $this->ProductId = $ProductId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(?int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}
