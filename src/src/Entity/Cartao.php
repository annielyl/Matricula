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
     * @ORM\Column(type="date")
     */
    private $dataValidade;

    /**
     * One Customer has One Cart.
     * ORM/OneToOne(targetEntity="Cliente", mappedBy="cartao",cascade={"ALL"})
     */
    private Cliente $cliente;

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

    public function getDataValidade(): ?\DateTimeInterface
    {
        return $this->dataValidade;
    }

    public function setDataValidade(\DateTimeInterface $dataValidade): self
    {
        $this->dataValidade = $dataValidade;

        return $this;
    }

    /**
     * @return Cliente
     */
    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    /**
     * @param Cliente $cliente
     */
    public function setCliente(Cliente $cliente): void
    {
        $this->cliente = $cliente;
    }
}
