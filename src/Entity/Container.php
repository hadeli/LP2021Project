<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use App\Repository\ContainerRepository;

/**
 * @ORM\Entity(repositoryClass=ContainerRepository::class)
 * @ORM\Table(name="CONTAINER")
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
     * @ORM\ManyToOne(targetEntity=ContainerModel::class)
     * @ORM\JoinColumn(nullable=false)
     * @Column(name="CONTAINER_MODEL_ID")
     * @ORM\Column(type="integer")
     */
    private $containerModel;

    /**
     * @ORM\ManyToOne(targetEntity=ContainerShip::class)
     * @ORM\JoinColumn(nullable=false)
     * @Column(name="CONTAINERSHIP_ID")
     * @ORM\Column(type="integer")
     */
    private $containerShip;

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

    public function getContainerModel(): ContainerModel|string|null
    {
        return $this->containerModel;
    }

    public function setContainerModel(?ContainerModel $containerModel): self
    {
        $this->containerModel = $containerModel;

        return $this;
    }

    public function getContainerShip(): ContainerShip|string|null
    {
        return $this->containerShip;
    }

    public function setContainerShip(?ContainerShip $containerShip): self
    {
        $this->containerShip = $containerShip;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}