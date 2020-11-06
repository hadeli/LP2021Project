<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $width;

    /**
     * @ORM\OneToMany(targetEntity=Containerproduct::class, mappedBy="product")
     */
    private $containerproducts;

    public function __construct()
    {
        $this->containerproducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return Collection|Containerproduct[]
     */
    public function getContainerproducts(): Collection
    {
        return $this->containerproducts;
    }

    public function addContainerproduct(Containerproduct $containerproduct): self
    {
        if (!$this->containerproducts->contains($containerproduct)) {
            $this->containerproducts[] = $containerproduct;
            $containerproduct->setProduct($this);
        }

        return $this;
    }

    public function removeContainerproduct(Containerproduct $containerproduct): self
    {
        if ($this->containerproducts->removeElement($containerproduct)) {
            // set the owning side to null (unless already changed)
            if ($containerproduct->getProduct() === $this) {
                $containerproduct->setProduct(null);
            }
        }

        return $this;
    }
}
