<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 */
class Position
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"vessel"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $lat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $lon;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vessel", mappedBy="position")
     */
    private $vessels;

    public function __construct()
    {
        $this->vessels = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?string
    {
        return $this->lon;
    }

    public function setLon(string $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return Collection|Vessel[]
     */
    public function getVessels(): Collection
    {
        return $this->vessels;
    }

    public function addVessel(Vessel $vessel): self
    {
        if (!$this->vessels->contains($vessel)) {
            $this->vessels[] = $vessel;
            $vessel->addPosition($this);
        }

        return $this;
    }

    public function removeVessel(Vessel $vessel): self
    {
        if ($this->vessels->contains($vessel)) {
            $this->vessels->removeElement($vessel);
            $vessel->removePosition($this);
        }

        return $this;
    }

}
