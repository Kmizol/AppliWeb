<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document", indexes={@ORM\Index(name="IdVisiteur", columns={"IdVisiteur"})})
 * @ORM\Entity
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(name="idJustificatif", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idjustificatif;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;

    /**
     * @var \Visiteur
     *
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdVisiteur", referencedColumnName="id")
     * })
     */
    private $idvisiteur;

    public function getIdjustificatif(): ?int
    {
        return $this->idjustificatif;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getIdvisiteur(): ?Visiteur
    {
        return $this->idvisiteur;
    }

    public function setIdvisiteur(?Visiteur $idvisiteur): self
    {
        $this->idvisiteur = $idvisiteur;

        return $this;
    }


}
