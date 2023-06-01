<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
//Ici on importe le package Vich, que l’on utilisera sous l’alias “Vich”
use App\Repository\WebsiteRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
#[Vich\Uploadable]
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

    #[Vich\UploadableField(mapping: 'portfolio_file', fileNameProperty: 'biglogo')]
    #[Assert\File(
        maxSize: '3M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg'],
    )]
    private File $biglogoFile;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $littlelogo;

    #[Vich\UploadableField(mapping: 'portfolio_file', fileNameProperty: 'littlelogo')]
    #[Assert\File(
        maxSize: '4M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/svg'],
    )]
    private File $littlelogoFile;

    #[ORM\Column(type: 'text', nullable: true)]
    private $aboutme;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'website', targetEntity: Contact::class, orphanRemoval: true)]
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
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


    public function getAboutme(): ?string
    {
        return $this->aboutme;
    }

    public function setAboutme(?string $aboutme): self
    {
        $this->aboutme = $aboutme;

        return $this;
    }

    public function setLittlelogoFile(File $image = null): Website
    {
        $this->littlelogoFile = $image;

        if ($image){
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

    public function getLittlelogoFile(): ?File
    {
        return $this->littlelogoFile;
    }

    public function setBiglogoFile(File $image = null): Website
    {
        $this->biglogoFile = $image;

        if ($image){
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

    public function getBiglogoFile(): ?File
    {
        return $this->biglogoFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setWebsite($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getWebsite() === $this) {
                $contact->setWebsite(null);
            }
        }

        return $this;
    }
}
