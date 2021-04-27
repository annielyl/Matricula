<?php

namespace App\Controller;

use App\Entity\Cartao;
use App\Form\Cartao1Type;
use App\Repository\CartaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cartao')]
class CartaoController extends AbstractController
{
    #[Route('/', name: 'cartao_index', methods: ['GET'])]
    public function index(CartaoRepository $cartaoRepository): Response
    {
        return $this->render('cartao/index.html.twig', [
            'cartaos' => $cartaoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'cartao_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $cartao = new Cartao();
        $form = $this->createForm(Cartao1Type::class, $cartao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cartao);
            $entityManager->flush();

            return $this->redirectToRoute('cartao_index');
        }

        return $this->render('cartao/new.html.twig', [
            'cartao' => $cartao,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'cartao_show', methods: ['GET'])]
    public function show(Cartao $cartao): Response
    {
        return $this->render('cartao/show.html.twig', [
            'cartao' => $cartao,
        ]);
    }

    #[Route('/{id}/edit', name: 'cartao_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cartao $cartao): Response
    {
        $form = $this->createForm(Cartao1Type::class, $cartao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cartao_index');
        }

        return $this->render('cartao/edit.html.twig', [
            'cartao' => $cartao,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'cartao_delete', methods: ['POST'])]
    public function delete(Request $request, Cartao $cartao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cartao->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cartao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cartao_index');
    }
}
