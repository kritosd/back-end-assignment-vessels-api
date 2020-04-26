<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VesselTypeRepository")
 * @ApiFilter(SearchFilter::class, properties={"name": "partial"})
 */
class VesselType
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vessel", mappedBy="status")
     */
    private $vessels;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
