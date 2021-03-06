<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProdutoRepository::class)
 */
class Produto
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
    private $nome;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;


    /**
     * @ORM\ManyToMany(targetEntity=Categoria::class, mappedBy="produtos")
     */
    private $categorias;

    /**
     * @ORM\ManyToMany(targetEntity=Carrinho::class, inversedBy="produtos")
     */
    private $carrinho;


    public function __construct()
    {
        $this->categorias = new ArrayCollection();
        $this->carrinho = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function __toString(){
        return $this->nome;
    }

    /**
     * @return Collection|Categoria[]
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
            $categoria->addProduto($this);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->removeElement($categoria)) {
            $categoria->removeProduto($this);
        }

        return $this;
    }

    /**
     * @return Collection|Carrinho[]
     */
    public function getCarrinho(): Collection
    {
        return $this->carrinho;
    }

    public function addCarrinho(Carrinho $carrinho): self
    {
        if (!$this->carrinho->contains($carrinho)) {
            $this->carrinho[] = $carrinho;
        }

        return $this;
    }

    public function removeCarrinho(Carrinho $carrinho): self
    {
        $this->carrinho->removeElement($carrinho);

        return $this;
    }


}
