<?php

namespace App\Tests\Repository;

class ScheduleRepositoryTest extends \App\Tests\Utils\DatabaseTestCase
{
    private ?ScheduleRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = ScheduleRepositoryTest::$container->get('ScheduleRepository::class');
    }

    public function testFinDefault(): void
    {
        $this->assertEmpty($this->repository->finDefault());

        $this->insertDefaultSchedule();
        $this->assertInstanceOf(Schedule::class, $this->repository->finDefault());

    }

    private function insertDefaultSchedule(): void
    {
        $default = Schedule::defaultSchedule();

        $this->entityManager->persist($default);
        $this->entityManager->flush();
    }
}