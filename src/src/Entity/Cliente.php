<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClienteRepository;


/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
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
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * One Customer has One Cart.
     * ORM/OneToOne(targetEntity="Endereco", mappedBy="cliente",cascade={"ALL"},nullable=false)
     */
    private Endereco $endereco;

    /**
     * One Customer has One Cart.
     * ORM/OneToOne(targetEntity="Cartao", mappedBy="cliente",cascade={"ALL"},nullable=false)
     */
    private Cartao $cartao;

    /**
     * @ORM\OneToMany(targetEntity=Produto::class, mappedBy="cliente")
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

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Endereco
     */
    public function getEndereco(): Endereco
    {
        return $this->endereco;
    }

    /**
     * @param Endereco $endereco
     */
    public function setEndereco(Endereco $endereco): void
    {
        $this->endereco = $endereco;
        $endereco->setCliente($this);
    }


    public function  __toString()
    {
        return $this->nome;
    }

    /**
     * @return Cartao
     */
    public function getCartao(): Cartao
    {
        return $this->cartao;
    }

    /**
     * @param Cartao $cartao
     */
    public function setCartao(Cartao $cartao): void
    {
        $this->cartao = $cartao;
        $cartao->setCliente($this);

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
            $produto->setCliente($this);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): self
    {
        if ($this->produtos->removeElement($produto)) {
            // set the owning side to null (unless already changed)
            if ($produto->getCliente() === $this) {
                $produto->setCliente(null);
            }
        }

        return $this;
    }

}
