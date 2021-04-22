<?php

namespace App\Entity;
use App\Repository\DisciplinaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
    * @ORM\Entity(repositoryClass=DisciplinaRepository::class)
    * @ORM\Table(name="disciplinas")
*/

class Disciplina
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank
     */

    private string $nome;
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank
     */
    private string $professor;
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank
     */
    private int $creditos;


    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }


    public function getProfessor(): string
    {
        return $this->professor;
    }


    public function setProfessor(string $professor): void
    {
        $this->professor= $professor;
    }


    public function getCreditos(): int
    {
        return $this->creditos;
    }


    public function setCreditos(float $creditos): void
    {
        $this->creditos = $creditos;
    }


}