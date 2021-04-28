<?php

namespace App\Entity;

use App\Repository\CartaoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartaoRepository::class)
 */
class Cartao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cvv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dataValidade;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="cartaos")
     */
    private $Cliente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getDataValidade(): ?string
    {
        return $this->dataValidade;
    }

    public function setDataValidade(string $dataValidade): self
    {
        $this->dataValidade = $dataValidade;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->Cliente;
    }

    public function setCliente(?Cliente $Cliente): self
    {
        $this->Cliente = $Cliente;

        return $this;
    }
    public function __toString(){
        return $this->numero;
    }
}
