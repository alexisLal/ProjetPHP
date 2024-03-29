<?php

namespace App\Entity;

use App\Repository\OutilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: OutilRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Outil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptif = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateP = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateM = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'outils')]
    private Collection $tags;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Images = null;


    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'Images')]
    private ?File $file = null;
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->dateM = new \DateTime();

        // Ne met à jour dateP que lors de la création de l'entité
        if ($this->dateP === null) {
            $this->dateP = new \DateTimeImmutable();
        }
    }

    public function __toString()
    {
        return $this->nom;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getDateP(): ?\DateTimeImmutable
    {
        return $this->dateP;
    }

    public function setDateP(\DateTimeImmutable $dateP): static
    {
        $this->dateP = $dateP;

        return $this;
    }

    public function getDateM(): ?\DateTimeInterface
    {
        return $this->dateM;
    }

    public function setDateM(\DateTimeInterface $dateM): static
    {
        $this->dateM = $dateM;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addOutil($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeOutil($this);
        }

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->Images;
    }

    public function setImages(string $Images): static
    {
        $this->Images = $Images;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

 /** 
 *@param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $file
 **/  


    public function setFile(File|UploadedFile|null $file): Outil
    {
        $this->file = $file;
    
        if (null !== $file) {
            $this->date_m = new \DateTimeImmutable();
            }
        return $this;
    }
}
