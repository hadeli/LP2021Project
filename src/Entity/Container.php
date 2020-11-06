<?php

namespace App\Entity;

use App\Repository\ContainerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerRepository::class)
 */
class Container
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $containerModelId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $containershipId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getContainerModelId(): ?int
    {
        return $this->containerModelId;
    }

    public function setContainerModelId(int $containerModelId): self
    {
        $this->containerModelId = $containerModelId;

        return $this;
    }

    public function getContainershipId(): ?int
    {
        return $this->containershipId;
    }

    public function setContainershipId(int $containershipId): self
    {
        $this->containershipId = $containershipId;

        return $this;
    }
}
