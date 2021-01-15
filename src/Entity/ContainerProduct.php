<?php

namespace App\Entity;

use App\Repository\ContainerProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="container_product", indexes={@ORM\Index(name="container_product_product_id_fk", columns={"product_id"}), @ORM\Index(name="container_product_container_id_fk", columns={"container_id"})})
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
     * @ORM\ManyToOne(targetEntity="Container")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="container_id", referencedColumnName="ID")
     * })
     */
    private $container_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="ID")
     * })

     */
    private $product_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContainerId(): ?int
    {
        return $this->container_id;
    }

    public function setContainerId(int $container_id): self
    {
        $this->container_id = $container_id;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
