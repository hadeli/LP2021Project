<?php

namespace App\Entity;

use App\Repository\CONTAINERPRODUCTRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CONTAINER_PRODUCT")
 * @ORM\Entity(repositoryClass=CONTAINERPRODUCTRepository::class)
 */
class CONTAINERPRODUCT
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="CONTAINER_ID", type="integer", nullable=true)
     */
    private $CONTAINER_ID;

    /**
     * @ORM\Column(name="PRODUCT_ID", type="integer", nullable=true)
     */
    private $PRODUCT_ID;

    /**
     * @ORM\Column(name="QUANTITY", type="integer", nullable=true)
     */
    private $QUANTITY;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCONTAINERID(): ?int
    {
        return $this->CONTAINER_ID;
    }

    public function setCONTAINERID(?int $CONTAINER_ID): self
    {
        $this->CONTAINER_ID = $CONTAINER_ID;

        return $this;
    }

    public function getPRODUCTID(): ?int
    {
        return $this->PRODUCT_ID;
    }

    public function setPRODUCTID(?int $PRODUCT_ID): self
    {
        $this->PRODUCT_ID = $PRODUCT_ID;

        return $this;
    }

    public function getQUANTITY(): ?int
    {
        return $this->QUANTITY;
    }

    public function setQUANTITY(?int $QUANTITY): self
    {
        $this->QUANTITY = $QUANTITY;

        return $this;
    }
}
