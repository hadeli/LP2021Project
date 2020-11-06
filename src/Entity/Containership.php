<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Containership
 *
 * @ORM\Table(name="CONTAINERSHIP")
 * @ORM\Entity(repositoryClass="App\Repository\ContainershipRepository")
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
     * @var string|null
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CAPTAIN_NAME", type="string", length=255, nullable=true)
     */
    private $captainName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CONTAINER_LIMIT", type="integer", nullable=true)
     */
    private $containerLimit;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getCaptainName(): ?string
    {
        return $this->captainName;
    }

    /**
     * @param string|null $captainName
     */
    public function setCaptainName(?string $captainName): void
    {
        $this->captainName = $captainName;
    }

    /**
     * @return int|null
     */
    public function getContainerLimit(): ?int
    {
        return $this->containerLimit;
    }

    /**
     * @param int|null $containerLimit
     */
    public function setContainerLimit(?int $containerLimit): void
    {
        $this->containerLimit = $containerLimit;
    }




}
