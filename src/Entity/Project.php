<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//Ici on importe le package Vich, que l’on utilisera sous l’alias “Vich”
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[Vich\Uploadable]
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $miniatureUrl = null;

    #[Vich\UploadableField(mapping: 'project_file', fileNameProperty: 'miniatureUrl')]
    #[Assert\File(
        maxSize: '3M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg'],
    )]
    private File $urlFile;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->sources = new ArrayCollection();
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

    public function getMiniatureUrl(): ?string
    {
        return $this->miniatureUrl;
    }

    public function setMiniatureUrl(?string $miniatureUrl): self
    {
        $this->miniatureUrl = $miniatureUrl;

        return $this;
    }

    public function setUrlFile(File $image = null): Image
    {
        $this->urlFile = $image;

        if ($image){
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

    public function getUrlFile(): ?File
    {
        return $this->urlFile;
    }
}
