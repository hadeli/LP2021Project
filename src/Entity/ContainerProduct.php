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
     * @ORM\Column(type="integer")
     */
    private $ContainerId;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProductId;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContainerId(): ?int
    {
        return $this->ContainerId;
    }

    public function setContainerId(int $ContainerId): self
    {
        $this->ContainerId = $ContainerId;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->ProductId;
    }

    public function setProductId(int $ProductId): self
    {
        $this->ProductId = $ProductId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}
