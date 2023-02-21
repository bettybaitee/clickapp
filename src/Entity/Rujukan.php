<?php

namespace App\Entity;

use App\Repository\RujukanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RujukanRepository::class)
 */
class Rujukan
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $template;

    /**
     * @ORM\ManyToOne(targetEntity=Flag::class, inversedBy="rujukans")
     */
    private $flag;

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

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getFlag(): ?Flag
    {
        return $this->flag;
    }

    public function setFlag(?Flag $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function __toString()
    {
        return $this->getTemplate();
    }
}
