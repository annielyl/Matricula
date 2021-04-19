<?php

namespace App\Controller;

use App\Entity\Disciplina;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $arqComp = new Disciplina("Arquitetura de Computadores", "Ewerson", 6);
        $aed = new Disciplina("Algoritmos e estrutura de dados", "Eduardo", 8);
        $aic = new Disciplina("Atividade de ic", "Emanuel", 4);

        $disciplinas = [$arqComp, $aed,$aic];

        return $this->render('home/index.html.twig', [
            "disciplinas" => $disciplinas
        ]);
    }
}
