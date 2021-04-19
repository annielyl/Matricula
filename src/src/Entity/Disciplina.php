<?php


namespace App\Entity;


class Disciplina
{
    private string $nome;
    private string $professor;
    private int $creditos;


    public function __construct(string $nome, string $professor,int $creditos)
    {
        $this->nome = $nome;
        $this->professor = $professor;
        $this->creditos = $creditos;
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


    public function setProfessor(string $Professor): void
    {
        $this->Professor= $professor;
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