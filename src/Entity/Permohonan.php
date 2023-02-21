<?php

namespace App\Entity;

use App\Repository\PermohonanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PermohonanRepository::class)
 */
class Permohonan
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
    private $tajuk;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTajuk(): ?string
    {
        return $this->tajuk;
    }

    public function setTajuk(?string $tajuk): self
    {
        $this->tajuk = $tajuk;

        return $this;
    }

    public function getSor(): ?string
    {
        return $this->sor;
    }

    public function setSor(?string $sor): self
    {
        $this->sor = $sor;

        return $this;
    }
}
