<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Container
 *
 * @ORM\Table(name="CONTAINER", uniqueConstraints={@ORM\UniqueConstraint(name="CONTAINER_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="CONTAINER_CONTAINER_MODEL_ID_fk", columns={"CONTAINER_MODEL_ID"}), @ORM\Index(name="CONTAINER_CONTAINERSHIP_ID_fk", columns={"CONTAINERSHIP_ID"})})
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
     * @var \Containership
     *
     * @ORM\ManyToOne(targetEntity="Containership")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CONTAINERSHIP_ID", referencedColumnName="ID")
     * })
     */
    private $containership;

    /**
     * @var \ContainerModel
     *
     * @ORM\ManyToOne(targetEntity="ContainerModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CONTAINER_MODEL_ID", referencedColumnName="ID")
     * })
     */
    private $containerModel;


}
