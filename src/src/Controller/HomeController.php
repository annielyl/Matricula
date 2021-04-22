<?php

namespace App\Controller;

use App\Entity\Disciplina;
use App\Form\DisciplinaType;
use App\Repository\DisciplinaRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DisciplinaRepository $disciplinaRepository): Response
    {

        $disciplinas = $disciplinaRepository->findAll();
        $form= $this->createForm(DisciplinaType::class);

        return $this->render('home/index.html.twig', [
            "disciplinas" => $disciplinas,
            "formDisciplina"=> $form->createView()
        ]);
    }

    /**
     *  @Route("/adicionar", name="adicionar")
     */
    public function adicionar(Request $request, DisciplinaRepository $disciplinaRepository)
    {
        $disciplinas = $disciplinaRepository->findAll();
        $form = $this->createForm(DisciplinaType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $disciplina = $form->getData();

            $disciplinaRepository->save($disciplina);

            $this->addFlash("message", "Matricula Solicitada");
            return $this->redirectToRoute("home");
        } else {
            return $this->render("home/index.html.twig", [
                "disciplinas" => $disciplinas,
                "formDisciplinas" => $form->createView()
            ]);
        }
    }

    /**
     *  @Route("/editar/{id}", name="editar")
     */

    public function editar(Disciplina $disciplina): Response
    {
        $form = $this->createForm(DisciplinaType::class,$disciplina);
        return $this->render('home/form.html.twig', [
            "disciplina"=>$disciplina,
            "formDisciplina" => $form->createView()
        ]);
    }
    /**
     * @Route("/editar/save/{id}", name="editar_save")
     */
    public function salvarEdicao(Request $request, Disciplina $disciplina,DisciplinaRepository $disciplinaRepository): Response
    {
        $form = $this->createForm(DisciplinaType::class,$disciplina);
        $form->handleRequest($request);
        $disciplina = $form->getData();
        $disciplinaRepository->save($disciplina);
        $this->addFlash("message", "Disciplina editada com sucesso");
        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/remove/{id}", name="remover")
     */
    public function remover(Disciplina $disciplina, DisciplinaRepository $disciplinaRepository): Response
    {
        $disciplinaRepository->remove($disciplina);
        $this->addFlash("message","Disciplina removida");
        return $this->redirectToRoute("home");
    }
}
