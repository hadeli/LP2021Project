<?php

namespace App\Entity;

use App\Repository\CONTAINERRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CONTAINERRepository::class)
 */
class CONTAINER
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $COLOR;

    /**
     * @ORM\Column(type="integer")
     */
    private $CONTAINER_MODEL_ID;

    /**
     * @ORM\Column(type="integer")
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

    public function getCONTAINERSHIPID(): ?int
    {
        return $this->CONTAINERSHIP_ID;
    }

    public function setCONTAINERMODELID(int $CONTAINER_MODEL_ID): self
    {
        $this->CONTAINER_MODEL_ID = $CONTAINER_MODEL_ID;

        return $this;
    }

    public function setCONTAINERSHIPID(int $CONTAINERSHIP_ID): self
    {
        $this->CONTAINERSHIP_ID = $CONTAINERSHIP_ID;

        return $this;
    }

}
