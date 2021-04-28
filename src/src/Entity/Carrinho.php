<?php

namespace App\Entity;

use App\Repository\CarrinhoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarrinhoRepository::class)
 */
class Carrinho
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
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="carrinhos")
     */
    private $cliente;

    /**
     * @ORM\ManyToMany(targetEntity=Produto::class, mappedBy="carrinho")
     */
    private $produtos;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|Produto[]
     */
    public function getProdutos(): Collection
    {
        return $this->produtos;
    }

    public function addProduto(Produto $produto): self
    {
        if (!$this->produtos->contains($produto)) {
            $this->produtos[] = $produto;
            $produto->addCarrinho($this);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): self
    {
        if ($this->produtos->removeElement($produto)) {
            $produto->removeCarrinho($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->descricao;
    }
}
