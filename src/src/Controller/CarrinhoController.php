<?php

namespace App\Controller;

use App\Entity\Carrinho;
use App\Form\Carrinho1Type;
use App\Repository\CarrinhoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carrinho')]
class CarrinhoController extends AbstractController
{
    #[Route('/', name: 'carrinho_index', methods: ['GET'])]
    public function index(CarrinhoRepository $carrinhoRepository): Response
    {
        return $this->render('carrinho/index.html.twig', [
            'carrinhos' => $carrinhoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'carrinho_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $carrinho = new Carrinho();
        $form = $this->createForm(Carrinho1Type::class, $carrinho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carrinho);
            $entityManager->flush();

            return $this->redirectToRoute('carrinho_index');
        }

        return $this->render('carrinho/new.html.twig', [
            'carrinho' => $carrinho,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'carrinho_show', methods: ['GET'])]
    public function show(Carrinho $carrinho): Response
    {
        return $this->render('carrinho/show.html.twig', [
            'carrinho' => $carrinho,
        ]);
    }

    #[Route('/{id}/edit', name: 'carrinho_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carrinho $carrinho): Response
    {
        $form = $this->createForm(Carrinho1Type::class, $carrinho);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carrinho_index');
        }

        return $this->render('carrinho/edit.html.twig', [
            'carrinho' => $carrinho,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'carrinho_delete', methods: ['POST'])]
    public function delete(Request $request, Carrinho $carrinho): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carrinho->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carrinho);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carrinho_index');
    }
}
