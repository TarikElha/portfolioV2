<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//Ici on importe le package Vich, que l’on utilisera sous l’alias “Vich”
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Image::class)]
    private $images;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'projects')]
    private $categories;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Source::class, orphanRemoval: true)]
    private $sources;

    /**
     * @var UploadedFile|null
    */
    private $imageProject;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageProjectName;
    

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->sources = new ArrayCollection();
    }


    //Cropper

    public function getImageProject(): ?UploadedFile
    {
        return $this->imageProject;
    }

    public function setImageProject(?UploadedFile $imageProject): void
    {
        $this->imageProject = $imageProject;
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProject($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProject() === $this) {
                $image->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Source>
     */
    public function getSources(): Collection
    {
        return $this->sources;
    }

    public function addSource(Source $source): self
    {
        if (!$this->sources->contains($source)) {
            $this->sources[] = $source;
            $source->setProject($this);
        }

        return $this;
    }

    public function removeSource(Source $source): self
    {
        if ($this->sources->removeElement($source)) {
            // set the owning side to null (unless already changed)
            if ($source->getProject() === $this) {
                $source->setProject(null);
            }
        }

        return $this;
    }

    public function getImageProjectName(): ?string
    {
        return $this->imageProjectName;
    }

    public function setImageProjectName(string $imageProjectName): self
    {
        $this->imageProjectName = $imageProjectName;

        return $this;
    }
}
