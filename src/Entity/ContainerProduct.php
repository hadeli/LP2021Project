<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContainerProduct
 *
 * @ORM\Table(name="container_product", indexes={@ORM\Index(name="CONTAINER_PRODUCT_PRODUCT_ID_fk", columns={"PRODUCT_ID"}), @ORM\Index(name="CONTAINER_PRODUCT_CONTAINER_ID_fk", columns={"CONTAINER_ID"})})
 * @ORM\Entity
 */
class ContainerProduct
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="QUANTITY", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var \Container
     *
     * @ORM\ManyToOne(targetEntity="Container")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CONTAINER_ID", referencedColumnName="ID")
     * })
     */
    private $container;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PRODUCT_ID", referencedColumnName="ID")
     * })
     */
    private $product;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return \Container
     */
    public function getContainer(): \Container
    {
        return $this->container;
    }

    /**
     * @param \Container $container
     */
    public function setContainer(\Container $container): void
    {
        $this->container = $container;
    }

    /**
     * @return \Product
     */
    public function getProduct(): \Product
    {
        return $this->product;
    }

    /**
     * @param \Product $product
     */
    public function setProduct(\Product $product): void
    {
        $this->product = $product;
    }


}
