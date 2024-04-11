<?php

namespace App\Test\Controller;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/emp/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Employee::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Employee index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'employee[Name]' => 'Testing',
            'employee[BirthDate]' => 'Testing',
            'employee[technology]' => 'Testing',
            'employee[gender]' => 'Testing',
            'employee[email_id]' => 'Testing',
            'employee[profile_link]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employee();
        $fixture->setName('My Title');
        $fixture->setBirthDate('My Title');
        $fixture->setTechnology('My Title');
        $fixture->setGender('My Title');
        $fixture->setEmail_id('My Title');
        $fixture->setProfile_link('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Employee');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employee();
        $fixture->setName('Value');
        $fixture->setBirthDate('Value');
        $fixture->setTechnology('Value');
        $fixture->setGender('Value');
        $fixture->setEmail_id('Value');
        $fixture->setProfile_link('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'employee[Name]' => 'Something New',
            'employee[BirthDate]' => 'Something New',
            'employee[technology]' => 'Something New',
            'employee[gender]' => 'Something New',
            'employee[email_id]' => 'Something New',
            'employee[profile_link]' => 'Something New',
        ]);

        self::assertResponseRedirects('/emp/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getBirthDate());
        self::assertSame('Something New', $fixture[0]->getTechnology());
        self::assertSame('Something New', $fixture[0]->getGender());
        self::assertSame('Something New', $fixture[0]->getEmail_id());
        self::assertSame('Something New', $fixture[0]->getProfile_link());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employee();
        $fixture->setName('Value');
        $fixture->setBirthDate('Value');
        $fixture->setTechnology('Value');
        $fixture->setGender('Value');
        $fixture->setEmail_id('Value');
        $fixture->setProfile_link('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/emp/');
        self::assertSame(0, $this->repository->count([]));
    }
}
