<?php

namespace App\Entity;

use App\Repository\CONTAINERMODELRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CONTAINER_MODEL")
 * @ORM\Entity(repositoryClass=CONTAINERMODELRepository::class)
 */
class CONTAINERMODEL
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
     * @ORM\Column(name="LENGTH", type="integer", nullable=true)
     */
    private $LENGTH;

    /**
     * @ORM\Column(name="WIDTH", type="integer", nullable=true)
     */
    private $WIDTH;

    /**
     * @ORM\Column(name="HEIGHT", type="integer", nullable=true)
     */
    private $HEIGHT;

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

    public function getLENGTH(): ?int
    {
        return $this->LENGTH;
    }

    public function setLENGTH(?int $LENGTH): self
    {
        $this->LENGTH = $LENGTH;

        return $this;
    }

    public function getWIDTH(): ?int
    {
        return $this->WIDTH;
    }

    public function setWIDTH(?int $WIDTH): self
    {
        $this->WIDTH = $WIDTH;

        return $this;
    }

    public function getHEIGHT(): ?int
    {
        return $this->HEIGHT;
    }

    public function setHEIGHT(?int $HEIGHT): self
    {
        $this->HEIGHT = $HEIGHT;

        return $this;
    }
}
