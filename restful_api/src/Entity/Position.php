<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 * @ApiFilter(NumericFilter::class, properties={"lat", "lon"})
 * @ApiFilter(RangeFilter::class, properties={"lat", "lon"})
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

    #@ORM\Column(type="string", length=255)
    /**
     * @ORM\Column(type="decimal", precision=10, scale=8)
     * @Groups({"vessel"})
     */
    private $lat;

    #@ORM\Column(type="string", length=255)
    /**
     * @ORM\Column(type="decimal", precision=11, scale=8)
     * @Groups({"vessel"})
     */
    private $lon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vessel", inversedBy="position")
     */
    private $vessel;


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

    public function getVessel(): ?Vessel
    {
        return $this->vessel;
    }

    public function setVessel(?Vessel $vessel): self
    {
        $this->vessel = $vessel;

        return $this;
    }

}
