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
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CONTAINER_ID;

    /**
     * @ORM\Column(type="integer")
     */
    private $PRODUCT_ID;

    /**
     * @ORM\Column(type="integer")
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

    public function getPRODUCTID(): ?int
    {
        return $this->PRODUCT_ID;
    }

    public function getQUANTITY(): ?int
    {
        return $this->QUANTITY;
    }

    public function setQUANTITY(int $QUANTITY): self
    {
        $this->QUANTITY = $QUANTITY;

        return $this;
    }
}
