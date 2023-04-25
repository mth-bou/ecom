<?php

namespace App\Tests\Utils;

use LogicException;
use \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use \Doctrine\ORM\Tools\Console\EntityManagerProvider;
use \Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\HttpKernel\KernelInterface;

class DatabaseTestCase extends KernelTestCase
{
    protected EntityManagerProvider $entityManagerProvider;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        if ('test' !== $kernel->getEnvironment()) {
            throw new LogicException('Execution only in test environment');
        }

        $this->initDatabase($kernel);

        $this->entityManagerProvider = $kernel->getContainer()->get('doctrine')->getManager();
    }

    private function initDatabase(KernelInterface $kernel): void
    {
        $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        $metaData = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->updateSchema($metaData);

    }
}