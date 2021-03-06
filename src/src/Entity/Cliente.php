<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClienteRepository;
use Symfony\Component\Validator\Constraints as Assert;



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
     * @Assert\NotBlank
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email(
     * message = "O e-mail '{{ value }}' não é valido."
     * )
     */
    private $email;

    /**
     * One Customer has One Cart.
     * ORM/OneToOne(targetEntity="Endereco", mappedBy="cliente",cascade={"ALL"},nullable=false)
     */
    private Endereco $endereco;

    /**
     * @ORM\OneToMany(targetEntity=Cartao::class, mappedBy="Cliente")
     */
    private $cartoes;

    /**
     * @ORM\OneToMany(targetEntity=Carrinho::class, mappedBy="Cliente")
     */
    private $carrinhos;


    public function __construct()
    {
        $this->cartoes = new ArrayCollection();
        $this->carrinhos = new ArrayCollection();
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


    /**
     * @return Collection|Cartao[]
     */
    public function getCartoes(): Collection
    {
        return $this->cartoes;
    }

    public function addCartao(Cartao $cartao): self
    {
        if (!$this->cartoes->contains($cartao)) {
            $this->cartoes[] = $cartao;
            $cartao->setCliente($this);
        }

        return $this;
    }

    public function removeCartao(Cartao $cartao): self
    {
        if ($this->cartoes->removeElement($cartao)) {
            // set the owning side to null (unless already changed)
            if ($cartao->getCliente() === $this) {
                $cartao->setCliente(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->nome;
    }

    /**
     * @return Collection|Carrinho[]
     */
    public function getCarrinhos(): Collection
    {
        return $this->carrinhos;
    }

    public function addCarrinho(Carrinho $carrinho): self
    {
        if (!$this->carrinhos->contains($carrinho)) {
            $this->carrinhos[] = $carrinho;
            $carrinho->setCliente($this);
        }

        return $this;
    }

    public function removeCarrinho(Carrinho $carrinho): self
    {
        if ($this->carrinhos->removeElement($carrinho)) {
            // set the owning side to null (unless already changed)
            if ($carrinho->getCliente() === $this) {
                $carrinho->setCliente(null);
            }
        }

        return $this;
    }

}
