<?php

namespace App\Entity;

use App\Repository\ContainerproductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerproductRepository::class)
 */
class Containerproduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=container::class, inversedBy="containerproducts")
     */
    private $container;

    /**
     * @ORM\ManyToOne(targetEntity=product::class, inversedBy="containerproducts")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getContainer(): ?container
    {
        return $this->container;
    }

    public function setContainer(?container $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
