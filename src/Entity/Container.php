<?php

namespace App\Entity;

use App\Repository\ContainerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=20, name="COLOR")
     * @Assert\Length(max=20, maxMessage="Une couleur ne peut pas dépasser 20 caractères")
     * @Assert\Type(type="alpha", message="{{ value }} n'est pas une couleur")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=ContainerModel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $containerModel;

    /**
     * @ORM\ManyToOne(targetEntity=Containership::class)
     * @ORM\JoinColumn(nullable=false)
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

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getContainerModel(): ?ContainerModel
    {
        return $this->containerModel;
    }

    public function setContainerModel(?ContainerModel $containerModel): self
    {
        $this->containerModel = $containerModel;

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