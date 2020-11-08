<?php

namespace App\Entity;

use App\Repository\ContainerProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerProductRepository::class)
 * @ORM\Table(name="`CONTAINER_PRODUCT`")
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
    private $container_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * ContainerProduct constructor.
     * @param $id
     * @param $container_id
     * @param $product_id
     * @param $quantity
     */
    public function __construct($id, $container_id, $product_id, $quantity)
    {
        $this->id = $id;
        $this->container_id = $container_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

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
