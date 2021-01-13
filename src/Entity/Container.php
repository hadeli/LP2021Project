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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=ContainerModel::class)
     */
    private $container_model;

    /**
     * @ORM\ManyToOne(targetEntity=Containership::class)
     */
    private $containership;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getContainerModel(): ?ContainerModel
    {
        return $this->container_model;
    }

    public function setContainerModel(?ContainerModel $container_model): self
    {
        $this->container_model = $container_model;

        return $this;
    }

    public function getContainership(): ?Containership
    {
        return $this->containership;
    }

    public function setContainership(?Containership $containership): self
    {
        $this->containership = $containership;

        return $this;
    }
}
