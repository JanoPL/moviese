<?php

namespace App\Controller\Rest;

use App\Entity\Rest\OutputJsonDto;
use App\Modules\RecommendationSystem\Interfaces\RecommendationSystemInterface;
use App\Repository\EntertainmentProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class EntertainmentProductController extends AbstractController
{
    private EntertainmentProductRepository $entertainmentProductRepository;
    private $serializer;

    public function __construct(
        EntertainmentProductRepository $entertainmentProductRepository,
        RecommendationSystemInterface $recommendationSystem
    ) {
        $this->entertainmentProductRepository = $entertainmentProductRepository;

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    #[Route('/entertainmentProduct', methods: ['GET'])]
    public function index() : Response
    {
        $products = $this->entertainmentProductRepository->findAll();

        $outputJsonDto = new OutputJsonDto();
        $outputJsonDto->setData($products);



        $json_content = $this->serializer->serialize($outputJsonDto, 'json');

        return new JsonResponse(
            data: $json_content,
            status: 200,
            headers: ['Content-Type' => 'application/json'],
            json: true
        );
    }
}