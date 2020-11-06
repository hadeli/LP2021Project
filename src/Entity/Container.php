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
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $container_model_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $containership_id;

    /**
     * Container constructor.
     * @param $id
     * @param $color
     * @param $container_model_id
     * @param $containership_id
     */
    public function __construct($id, $color, $container_model_id, $containership_id)
    {
        $this->id = $id;
        $this->color = $color;
        $this->container_model_id = $container_model_id;
        $this->containership_id = $containership_id;
    }

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
        return $this->container_model_id;
    }

    public function setContainerModelId(int $container_model_id): self
    {
        $this->container_model_id = $container_model_id;

        return $this;
    }

    public function getContainershipId(): ?int
    {
        return $this->containership_id;
    }

    public function setContainershipId(int $containership_id): self
    {
        $this->containership_id = $containership_id;

        return $this;
    }
}
