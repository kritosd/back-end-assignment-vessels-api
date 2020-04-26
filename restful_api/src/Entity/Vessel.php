<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Uuid;

/**
 * @ApiResource(normalizationContext={"groups"={"vessel"}})
 * @ORM\Entity(repositoryClass="App\Repository\VesselRepository")
 * @ApiFilter(SearchFilter::class, properties={"mmsi": "exact", "length": "exact", "width": "exact"})
 * @ApiFilter(NumericFilter::class, properties={"length", "width"})
 * @ApiFilter(RangeFilter::class, properties={"position.lat", "position.lon"})
 */
class Vessel
{
    /**
     * @ORM\Id()
     * @Groups({"vessel"})
     * @ApiProperty(identifier=true)
     * @ORM\Column(type="string", length=255)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $callsign;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=2)
     * @Groups({"vessel"})
     */
    private $length;

    /**
     * @ORM\Column(type="decimal", precision=19, scale=2)
     * @Groups({"vessel"})
     */
    private $width;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $mmsi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $draught;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $heading;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $course;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"vessel"})
     */
    private $speed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VesselType", inversedBy="vessels")
     * @ApiSubresource
     * @Groups({"vessel"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VesselStatus", inversedBy="vessels")
     * @ApiSubresource
     * @Groups({"vessel"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Position", mappedBy="vessel")
     * @ApiSubresource
     * @Groups({"vessel"})
     */
    private $position;

    public function __construct()
    {
        $this->position = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCallsign(): ?string
    {
        return $this->callsign;
    }

    public function setCallsign(string $callsign): self
    {
        $this->callsign = $callsign;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getMmsi(): ?string
    {
        return $this->mmsi;
    }

    public function setMmsi(string $mmsi): self
    {
        $this->mmsi = $mmsi;

        return $this;
    }

    public function getDraught(): ?string
    {
        return $this->draught;
    }

    public function setDraught(string $draught): self
    {
        $this->draught = $draught;

        return $this;
    }

    public function getType(): ?VesselType
    {
        return $this->type;
    }

    public function setType(VesselType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?VesselStatus
    {
        return $this->status;
    }

    public function setStatus(?VesselStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function setHeading(string $heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(string $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return Collection|Position[]
     */
    public function getPosition(): Collection
    {
        return $this->position;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->position->contains($position)) {
            $this->position[] = $position;
            $position->setVessel($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->position->contains($position)) {
            $this->position->removeElement($position);
            // set the owning side to null (unless already changed)
            if ($position->getVessel() === $this) {
                $position->setVessel(null);
            }
        }

        return $this;
    }

}
