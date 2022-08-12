<?php

namespace App\Entity;

use App\Repository\WebsiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
class Website
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $biglogo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $littlelogo;

    #[ORM\Column(type: 'integer')]
    private $typeportfolio;

    #[ORM\Column(type: 'text', nullable: true)]
    private $aboutme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBiglogo(): ?string
    {
        return $this->biglogo;
    }

    public function setBiglogo(?string $biglogo): self
    {
        $this->biglogo = $biglogo;

        return $this;
    }

    public function getLittlelogo(): ?string
    {
        return $this->littlelogo;
    }

    public function setLittlelogo(?string $littlelogo): self
    {
        $this->littlelogo = $littlelogo;

        return $this;
    }

    public function getTypeportfolio(): ?int
    {
        return $this->typeportfolio;
    }

    public function setTypeportfolio(int $typeportfolio): self
    {
        $this->typeportfolio = $typeportfolio;

        return $this;
    }

    public function getAboutme(): ?string
    {
        return $this->aboutme;
    }

    public function setAboutme(?string $aboutme): self
    {
        $this->aboutme = $aboutme;

        return $this;
    }
}
