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
     * @ORM\ManyToOne(targetEntity=CONTAINERMODEL::class)
     */
    private $CONTAINER_MODEL;

    /**
     * @ORM\ManyToOne(targetEntity=CONTAINERSHIP::class)
     */
    private $CONTAINERSHIP;

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

    public function getCONTAINERMODEL(): ?CONTAINERMODEL
    {
        return $this->CONTAINER_MODEL;
    }

    public function setCONTAINERMODEL(?CONTAINERMODEL $CONTAINER_MODEL): self
    {
        $this->CONTAINER_MODEL = $CONTAINER_MODEL;

        return $this;
    }

    public function getCONTAINERSHIP(): ?CONTAINERSHIP
    {
        return $this->CONTAINERSHIP;
    }

    public function setContainership(?Containership $containership): self
    {
        return $this->CONTAINERSHIP;
    }

}
