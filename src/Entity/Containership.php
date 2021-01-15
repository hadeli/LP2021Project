<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Containership
 *
 * @ORM\Table(name="containership")
 * @ORM\Entity
 */
class Containership
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="captain_name", type="string", length=255, nullable=false)
     */
    private $captainName;

    /**
     * @var int
     *
     * @ORM\Column(name="container_limit", type="integer", nullable=false)
     */
    private $containerLimit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCaptainName(): ?string
    {
        return $this->captainName;
    }

    public function setCaptainName(string $captainName): self
    {
        $this->captainName = $captainName;

        return $this;
    }

    public function getContainerLimit(): ?int
    {
        return $this->containerLimit;
    }

    public function setContainerLimit(int $containerLimit): self
    {
        $this->containerLimit = $containerLimit;

        return $this;
    }


}
