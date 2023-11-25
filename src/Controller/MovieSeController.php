<?php

namespace App\Controller;

use App\Entity\EntertainmentProduct;
use App\Form\EntertainmentProductType;
use App\Repository\EntertaimentProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie/se')]
class MovieSeController extends AbstractController
{
    #[Route('/', name: 'app_movie_se_index', methods: ['GET'])]
    public function index(EntertaimentProductRepository $entertainmentProductRepository): Response
    {
        return $this->render('movie_se/index.html.twig', [
            'entertainment_products' => $entertainmentProductRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_movie_se_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $entertainmentProduct = new EntertainmentProduct();
        $form = $this->createForm(EntertainmentProductType::class, $entertainmentProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entertainmentProduct);
            $entityManager->flush();

            return $this->redirectToRoute('app_movie_se_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('movie_se/new.html.twig', [
            'entertainment_product' => $entertainmentProduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movie_se_show', methods: ['GET'])]
    public function show(EntertainmentProduct $entertainmentProduct): Response
    {
        return $this->render('movie_se/show.html.twig', [
            'entertainmentProductRepository' => $entertainmentProduct,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_movie_se_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntertainmentProduct $entertainmentProduct, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntertainmentProductType::class, $entertainmentProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_movie_se_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('movie_se/edit.html.twig', [
            'entertainment_product' => $entertainmentProduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movie_se_delete', methods: ['POST'])]
    public function delete(Request $request, EntertainmentProduct $entertainmentProduct, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entertainmentProduct->getId(), $request->request->get('_token'))) {
            $entityManager->remove($entertainmentProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_movie_se_index', [], Response::HTTP_SEE_OTHER);
    }
}
