<?php

namespace App\Entity;

use App\Entity\ContainerModel;
use App\Entity\Containership;
use Doctrine\ORM\Mapping as ORM;

/**
 * Container
 *
 * @ORM\Table(name="container", uniqueConstraints={@ORM\UniqueConstraint(name="CONTAINER_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="CONTAINER_CONTAINER_MODEL_ID_fk", columns={"CONTAINER_MODEL_ID"}), @ORM\Index(name="CONTAINER_CONTAINERSHIP_ID_fk", columns={"CONTAINERSHIP_ID"})})
 * @ORM\Entity
 */
class Container
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
     * @var string|null
     *
     * @ORM\Column(name="COLOR", type="string", length=20, nullable=true)
     */
    private $color;

    /**
     * @var Containership
     *
     * @ORM\ManyToOne(targetEntity="Containership")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CONTAINERSHIP_ID", referencedColumnName="ID")
     * })
     */
    private $containership;

    /**
     * @var ContainerModel
     *
     * @ORM\ManyToOne(targetEntity="ContainerModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CONTAINER_MODEL_ID", referencedColumnName="ID")
     * })
     */
    private $containerModel;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return Containership
     */
    public function getContainership(): Containership
    {
        return $this->containership;
    }

    /**
     * @param Containership $containership
     */
    public function setContainership(Containership $containership): void
    {
        $this->containership = $containership;
    }

    /**
     * @return ContainerModel
     */
    public function getContainerModel(): ContainerModel
    {
        return $this->containerModel;
    }

    /**
     * @param ContainerModel $containerModel
     */
    public function setContainerModel(ContainerModel $containerModel): void
    {
        $this->containerModel = $containerModel;
    }



}
