<?php

namespace App\Tests\Controller\Rest;

use App\Entity\EntertainmentProduct;
use App\Entity\Movie;
use App\Entity\Rest\OutputJsonDto;
use App\Repository\EntertainmentProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EntertainmentProductControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntertainmentProductRepository $repository;
    private string $path = 'api/v1/entertainmentProduct';
    private EntityManagerInterface $manager;
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(EntertainmentProduct::class);
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    private function insertData(): void
    {
        $fixture1 = new Movie();
        $fixture1->setName("Test Movie");
        $fixture1->setType('movie');
        $fixture1->setGenre('Drama');
        $this->manager->persist($fixture1);

        $fixture2 = new Movie();
        $fixture2->setName("Test Movie 2");
        $fixture2->setType('movie');
        $fixture2->setGenre('Drama');
        $this->manager->persist($fixture2);

        $fixture3 = new Movie();
        $fixture3->setName("Movie");
        $fixture3->setType('movie');
        $fixture3->setGenre('Drama');
        $this->manager->persist($fixture3);

        $this->manager->flush();
    }

    public function testIndexAction(): void
    {
        $this->insertData();

        $this->client->request('GET', $this->path);
        $response = $this->client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testIndexActionBody()
    {
        $this->client->request('GET', 'api/v1/entertainmentProduct');
        $response = $this->client->getResponse();

        $this->assertSame(200, $response->getStatusCode());

        $actual = $response->getContent();

        $expected = $this->serializer->serialize((new OutputJsonDto())->setData($this->repository->findAll()), 'json');

        $this->assertEquals($expected, $actual);
    }
}
