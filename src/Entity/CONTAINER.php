<?php

namespace App\Entity;

use App\Repository\CONTAINERRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CONTAINER")
 * @ORM\Entity(repositoryClass=CONTAINERRepository::class)
 */
class CONTAINER
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="COLOR", type="string", length=20, nullable=true)
     */
    private $COLOR;

    /**
     * @ORM\Column(name="CONTAINER_MODEL_ID", type="integer", nullable=true)
     */
    private $CONTAINER_MODEL_ID;

    /**
     * @ORM\Column(name="CONTAINERSHIP_ID", type="integer", nullable=true)
     */
    private $CONTAINERSHIP_ID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCOLOR(): ?string
    {
        return $this->COLOR;
    }

    public function setCOLOR(string $COLOR): self
    {
        $this->COLOR = $COLOR;

        return $this;
    }

    public function getCONTAINERMODELID(): ?int
    {
        return $this->CONTAINER_MODEL_ID;
    }

    public function setCONTAINERMODELID(?int $CONTAINER_MODEL_ID): self
    {
        $this->CONTAINER_MODEL_ID = $CONTAINER_MODEL_ID;

        return $this;
    }

    public function getCONTAINERSHIPID(): ?int
    {
        return $this->CONTAINERSHIP_ID;
    }

    public function setCONTAINERSHIPID(?int $CONTAINERSHIP_ID): self
    {
        $this->CONTAINERSHIP_ID = $CONTAINERSHIP_ID;

        return $this;
    }
}