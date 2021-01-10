<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContainerProduct
 *
 * @ORM\Table(name="CONTAINER_PRODUCT", indexes={@ORM\Index(name="CONTAINER_PRODUCT_CONTAINER_ID_fk", columns={"CONTAINER_ID"}), @ORM\Index(name="CONTAINER_PRODUCT_PRODUCT_ID_fk", columns={"PRODUCT_ID"})})
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


}
