<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Containership
 *
 * @ORM\Table(name="CONTAINERSHIP")
 * @ORM\Entity
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


}
