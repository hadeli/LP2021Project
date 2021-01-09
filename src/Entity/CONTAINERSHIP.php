<?php

namespace App\Entity;

use App\Repository\CONTAINER_SHIPRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CONTAINERSHIP")
 * @ORM\Entity(repositoryClass=CONTAINER_SHIPRepository::class)
 */
class CONTAINERSHIP
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="NAME", type="string", length=255, nullable=true)
     */
    private $NAME;

    /**
     * @ORM\Column(name="CAPTAIN_NAME", type="string", length=255, nullable=true)
     */
    private $CAPTAIN_NAME;

    /**
     * @ORM\Column(name="CONTAINER_LIMIT", type="integer", nullable=true)
     */
    private $CONTAINER_LIMIT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNAME(): ?string
    {
        return $this->NAME;
    }

    public function setNAME(?string $NAME): self
    {
        $this->NAME = $NAME;

        return $this;
    }

    public function getCAPTAINNAME(): ?string
    {
        return $this->CAPTAIN_NAME;
    }

    public function setCAPTAINNAME(?string $CAPTAIN_NAME): self
    {
        $this->CAPTAIN_NAME = $CAPTAIN_NAME;

        return $this;
    }

    public function getCONTAINERLIMIT(): ?int
    {
        return $this->CONTAINER_LIMIT;
    }

    public function setCONTAINERLIMIT(?int $CONTAINER_LIMIT): self
    {
        $this->CONTAINER_LIMIT = $CONTAINER_LIMIT;

        return $this;
    }
}