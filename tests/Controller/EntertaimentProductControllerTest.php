<?php

namespace App\Test\Controller;

use App\Entity\EntertainmentProduct;
use App\Entity\Movie;
use App\Repository\EntertainmentProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntertaimentProductControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntertainmentProductRepository $repository;
    private string $path = '/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(EntertainmentProduct::class);
        $this->manager = static::getContainer()->get('doctrine')->getManager();

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

    public function testIndex(): void
    {
        $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EntertainmentProduct index');
    }

    public function testNewMovie(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'entertainment_product[name]' => "Testing Movies",
            'entertainment_product[type]' => 'movie'
        ]);

        self::assertResponseRedirects('/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testNewSeries(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'entertainment_product[name]' => "Testing Series",
            'entertainment_product[type]' => 'series'
        ]);

        self::assertResponseRedirects('/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $fixture = new Movie();
        $fixture->setName("Test Movie");
        $fixture->setType('movie');
        $fixture->setGenre('Drama');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EntertainmentProduct');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $fixture = new Movie();
        $fixture->setName("Test Movie");
        $fixture->setType('movie');
        $fixture->setGenre('Drama');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'entertainment_product[name]' => 'Something new'
        ]);

        self::assertResponseRedirects('/');

        $fixture = $this->repository->findAll();
    }

    public function testRemove(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Movie();
        $fixture->setName("Test Movie");
        $fixture->setType('movie');
        $fixture->setGenre('Drama');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository - 1, count($this->repository->findAll()));
        self::assertResponseRedirects('/');
    }

    public function testFilterView(): void
    {
        $this->insertData();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));

        $crawler = $this->client->request('GET', sprintf('%s', $this->path));

        $this->client->submitForm('Filter', [
            'filter[filter]' => '1'
        ]);

        self::assertResponseStatusCodeSame(200);
    }

    public function testFilterForm(): void
    {
        $this->insertData();

        $originalNumObjectsInRepository = count($this->repository->findAll());
        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));

        $crawler = $this->client->request('GET', sprintf('%s', $this->path));

        $this->assertResponseIsSuccessful();

        $formCount = $crawler->filter('form')->count();

        self::assertGreaterThan(0, $formCount);

        $crawler = $this->client->submitForm('Filter', [
            'filter[filter]' => '3'
        ]);

        $trCount = $crawler->filter('table')->filter('tbody')->filter('tr')->count();

        self::assertEquals(2, $trCount);
    }
}
