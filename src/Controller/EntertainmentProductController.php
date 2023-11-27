<?php

namespace App\Controller;

use App\Entity\EntertainmentProduct;
use App\Entity\Movie;
use App\Entity\Series;
use App\Form\EntertainmentProductType;
use App\Form\FilterType;
use App\Modules\RecommendationSystem\Interfaces\RecommendationSystemInterface;
use App\Repository\EntertainmentProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Recommendations\StrategyEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entertainment/product')]
class EntertainmentProductController extends AbstractController
{
    private EntertainmentProductRepository $entertainmentProductRepository;
    private RecommendationSystemInterface $recommendationService;
    public function __construct(
        EntertainmentProductRepository $entertainmentProductRepository,
        RecommendationSystemInterface $recommendationSystem
    ) {
        $this->entertainmentProductRepository = $entertainmentProductRepository;
        $this->recommendationService = $recommendationSystem;
    }
    #[Route('/', name: 'app_entertainment_product_index', methods: ['GET'])]
    public function index(): Response
    {
        $filterForm = $this->createForm(FilterType::class);

        return $this->render('entertainment_product/index.html.twig', [
            'entertainment_products' => $this->entertainmentProductRepository->findAll(),
            'filterForm' => $filterForm,
        ]);
    }

    #[Route('/new', name: 'app_entertainment_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $entertainmentProduct = new EntertainmentProduct();

        $formEntertainmentProduct = $this->createForm(EntertainmentProductType::class, $entertainmentProduct);

        $formEntertainmentProduct->handleRequest($request);

        if ($formEntertainmentProduct->isSubmitted() && $formEntertainmentProduct->isValid()) {
            $entertainmentProduct = $formEntertainmentProduct->getNormData();

            $type = $request->get('entertainment_product')['type'];

            if ($type == 'series'){
                $series = new Series();
                $series->setName($entertainmentProduct->getName());
                $series->setType($entertainmentProduct->getType());
                $entityManager->persist($series);
                $entityManager->flush();
            }

            if ($type == 'movie') {
                $movie = new Movie();
                $movie->setName($entertainmentProduct->getName());
                $movie->setType($entertainmentProduct->getType());
                $entityManager->persist($movie);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_entertainment_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('entertainment_product/new.html.twig', [
            'entertainment_product' => $entertainmentProduct,
            'form' => $formEntertainmentProduct,
        ]);
    }

    #[Route('/{id}', name: 'app_entertainment_product_show', methods: ['GET'])]
    public function show(EntertainmentProduct $entertainmentProduct): Response
    {
        return $this->render('entertainment_product/show.html.twig', [
            'entertainment_product' => $entertainmentProduct,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entertainment_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntertainmentProduct $entertainmentProduct, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntertainmentProductType::class, $entertainmentProduct);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entertainment_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('entertainment_product/edit.html.twig', [
            'entertainment_product' => $entertainmentProduct,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entertainment_product_delete', methods: ['POST'])]
    public function delete(Request $request, EntertainmentProduct $entertainmentProduct, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entertainmentProduct->getId(), $request->request->get('_token'))) {
            $entityManager->remove($entertainmentProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entertainment_product_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/', 'app_entertainment_product_filter', methods: 'POST')]
    public function filter(Request $request) {
        $filterForm = $this->createForm(FilterType::class);

        $filterForm->handleRequest($request);

        $results = $this->entertainmentProductRepository->findAll();

        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $filter = $filterForm->getData()['filter']->name;

            switch ($filter) {
                case StrategyEnum::Even->name:
                    $results = $this->recommendationService->evenFilter($results);
                    break;
                case StrategyEnum::MultiWords->name:
                    $results = $this->recommendationService->multiWordsFilter($results);
                    break;
                case StrategyEnum::Random->name:
                    $results = $this->recommendationService->randomFilter($results);
                    break;
                case StrategyEnum::WCriteria->name:
                    $results = $this->recommendationService->wCriteriaFilter($results);
                    break;
                case StrategyEnum::Genre->name:
                    $results = $this->recommendationService->genreFilter($results);
                    break;
                case StrategyEnum::SeasonNumber->name:
                    $results = $this->recommendationService->seasonNumberFilter($results);
                    break;
            }
        }

        return $this->render('entertainment_product/index.html.twig', [
            'entertainment_products' => $results,
            'filterForm' => $filterForm,
        ]);
    }
}
