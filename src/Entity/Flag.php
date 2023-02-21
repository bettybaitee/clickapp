<?php

namespace App\Entity;

use App\Repository\FlagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlagRepository::class)
 */
class Flag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nama;

    /**
     * @ORM\OneToMany(targetEntity=Rujukan::class, mappedBy="flag")
     */
    private $rujukans;

    public function __construct()
    {
        $this->rujukans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNama(): ?string
    {
        return $this->nama;
    }

    public function setNama(?string $nama): self
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * @return Collection<int, Rujukan>
     */
    public function getRujukans(): Collection
    {
        return $this->rujukans;
    }

    public function addRujukan(Rujukan $rujukan): self
    {
        if (!$this->rujukans->contains($rujukan)) {
            $this->rujukans[] = $rujukan;
            $rujukan->setFlag($this);
        }

        return $this;
    }

    public function removeRujukan(Rujukan $rujukan): self
    {
        if ($this->rujukans->removeElement($rujukan)) {
            // set the owning side to null (unless already changed)
            if ($rujukan->getFlag() === $this) {
                $rujukan->setFlag(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNama();
    }
}
