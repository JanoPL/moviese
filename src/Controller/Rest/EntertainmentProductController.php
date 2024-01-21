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
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class EntertainmentProductController extends AbstractController
{
    private EntertainmentProductRepository $entertainmentProductRepository;
    private CacheInterface $cache;
    private $serializer;

    public function __construct(
        EntertainmentProductRepository $entertainmentProductRepository,
        RecommendationSystemInterface $recommendationSystem,
        CacheInterface $cache
    ) {
        $this->entertainmentProductRepository = $entertainmentProductRepository;
        $this->cache = $cache;

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    #[Route('/entertainmentProduct', methods: ['GET'])]
    public function index() : Response
    {
        $json_content = $this->cache->get('entertainmentProduct_cache', function (ItemInterface $item) {
            $item->expiresAfter(30);
            $products = $this->entertainmentProductRepository->findAll();

            $outputJsonDto = new OutputJsonDto();
            $outputJsonDto->setData($products);

            return $this->serializer->serialize($outputJsonDto, 'json');
        });

        return new JsonResponse(
            data: $json_content,
            status: 200,
            headers: ['Content-Type' => 'application/json'],
            json: true
        );
    }
}