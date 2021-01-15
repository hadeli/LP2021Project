<?php

namespace App\Entity;

use App\Repository\CONTAINERPRODUCTRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CONTAINERPRODUCTRepository::class)
 */
class CONTAINERPRODUCT
{
    /**
     * @ORM\Id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CONTAINER::class)
     */
    private $CONTAINER;

    /**
     * @ORM\ManyToOne(targetEntity=PRODUCT::class)
     */
    private $PRODUCT;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $QUANTITY;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCONTAINER(): ?CONTAINER
    {
        return $this->CONTAINER;
    }

    public function setCONTAINER(?CONTAINER $CONTAINER): self
    {
        $this->CONTAINER = $CONTAINER;

        return $this;
    }

    public function getPRODUCT(): ?PRODUCT
    {
        return $this->PRODUCT;
    }

    public function setPRODUCT(?PRODUCT $PRODUCT): self
    {
        $this->PRODUCT = $PRODUCT;

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
