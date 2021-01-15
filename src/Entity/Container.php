<?php

namespace App\Entity;

use App\Repository\ContainerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="container", indexes={@ORM\Index(name="container_container_model_id_fk", columns={"container_model_id"}), @ORM\Index(name="container_containership_id_fk", columns={"containership_id"})})
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
     * @ORM\ManyToOne(targetEntity="ContainerModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="container_model_id", referencedColumnName="ID")
     * })
     */
    private $container_model_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Containership")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="containership_id", referencedColumnName="ID")
     * })
     */
    private $containership_id;

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

    public function __toString()
    {
        return $this->color;
    }
}
