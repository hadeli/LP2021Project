<?php

namespace App\Entity;

use App\Repository\CONTAINERMODELRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CONTAINERMODELRepository::class)
 */
class CONTAINERMODEL
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NAME;

    /**
     * @ORM\Column(type="integer")
     */
    private $LENGHT;

    /**
     * @ORM\Column(type="integer")
     */
    private $WIDTH;

    /**
     * @ORM\Column(type="integer")
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

    public function setNAME(string $NAME): self
    {
        $this->NAME = $NAME;

        return $this;
    }

    public function getLENGHT(): ?int
    {
        return $this->LENGHT;
    }

    public function setLENGHT(int $LENGHT): self
    {
        $this->LENGHT = $LENGHT;

        return $this;
    }

    public function getWIDTH(): ?int
    {
        return $this->WIDTH;
    }

    public function setWIDTH(int $WIDTH): self
    {
        $this->WIDTH = $WIDTH;

        return $this;
    }

    public function getHEIGHT(): ?int
    {
        return $this->HEIGHT;
    }

    public function setHEIGHT(int $HEIGHT): self
    {
        $this->HEIGHT = $HEIGHT;

        return $this;
    }
}
