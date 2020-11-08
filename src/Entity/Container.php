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
     * @ORM\Column(type="string", length=20)
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $ContainerModelId;

    /**
     * @ORM\Column(type="integer")
     */
    private $ContainershipId;

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
        return $this->ContainerModelId;
    }

    public function setContainerModelId(int $ContainerModelId): self
    {
        $this->ContainerModelId = $ContainerModelId;

        return $this;
    }

    public function getContainershipId(): ?int
    {
        return $this->ContainershipId;
    }

    public function setContainershipId(int $ContainershipId): self
    {
        $this->ContainershipId = $ContainershipId;

        return $this;
    }
}
