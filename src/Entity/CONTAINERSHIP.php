<?php

namespace App\Entity;

use App\Repository\CONTAINERSHIPRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CONTAINERSHIPRepository::class)
 */
class CONTAINERSHIP
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=CONTAINER::class, mappedBy="CONTAINERSHIP_ID")
     */
    private $cONTAINERs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NAME;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CAPTAIN_NAME;

    /**
     * @ORM\Column(type="integer")
     */
    private $CONTAINER_LIMIT;

    public function __construct()
    {
        $this->cONTAINERs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CONTAINER[]
     */
    public function getCONTAINERs(): Collection
    {
        return $this->cONTAINERs;
    }

    public function addCONTAINER(CONTAINER $cONTAINER): self
    {
        if (!$this->cONTAINERs->contains($cONTAINER)) {
            $this->cONTAINERs[] = $cONTAINER;
            $cONTAINER->addCONTAINERSHIPID($this);
        }

        return $this;
    }

    public function removeCONTAINER(CONTAINER $cONTAINER): self
    {
        if ($this->cONTAINERs->removeElement($cONTAINER)) {
            $cONTAINER->removeCONTAINERSHIPID($this);
        }

        return $this;
    }

    public function getNAME(): ?string
    {
        return $this->NAME;
    }

    public function setNAME(string $NAME): self
    {
        $this->NAME = $NAME;

        return $this;
    }

    public function getCAPTAINNAME(): ?string
    {
        return $this->CAPTAIN_NAME;
    }

    public function setCAPTAINNAME(string $CAPTAIN_NAME): self
    {
        $this->CAPTAIN_NAME = $CAPTAIN_NAME;

        return $this;
    }

    public function getCONTAINERLIMIT(): ?int
    {
        return $this->CONTAINER_LIMIT;
    }

    public function setCONTAINERLIMIT(int $CONTAINER_LIMIT): self
    {
        $this->CONTAINER_LIMIT = $CONTAINER_LIMIT;

        return $this;
    }
}
