<?php

namespace App\Controller;

use App\Entity\Disciplina;
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

        return $this->render('home/index.html.twig', [
            "disciplinas" => $disciplinas
        ]);
    }

    /**
     *  @Route("/adicionar", name="adicionar")
     */
    public function adicionar(Request $request, DisciplinaRepository $disciplinaRepository){
        $nome= $request->get('nome');
        $professor=$request->get('professor');
        $creditos=$request->get('creditos');

        if($nome=="" || $professor=="" || $creditos==""){

            $this->addFlash("message","Preencha todos os campos para adicionar");
            return $this->redirectToRoute("home");

        }
   
        $disciplina= new Disciplina($nome,$professor,$creditos);
        $disciplinaRepository->save($disciplina);

        $this->addFlash("message","Matricula Solicitada");
        return $this->redirectToRoute("home");

    }

    /**
     *  @Route("/editar/{id}", name="editar")
     */

    public function editar(Disciplina $disciplina): Response
    {
        return $this->render('home/form.html.twig', [
            "disciplina"=>$disciplina
        ]);
    }
    /**
     * @Route("/editar/save/{id}", name="editar_save")
     */
    public function salvarEdicao(Request $request, Disciplina $disciplina,DisciplinaRepository $disciplinaRepository): Response
    {
        $nome=$request->get('nome');
        $professor=$request->get('professor');
        $creditos=$request->get('creditos');

        if($nome=="" || $professor=="" || $creditos==""){

            $this->addFlash("message","Preencha todos os campos para editar");
            return $this->redirectToRoute("home");

        }
    

        $disciplina->setNome($nome);
        $disciplina->setProfessor($professor);
        $disciplina->setCreditos($creditos);

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
