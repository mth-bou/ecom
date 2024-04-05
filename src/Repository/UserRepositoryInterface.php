<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function remove(User $user): void;
    public function edit(User $user, ?array $fields): void;
    public function findByEmail(string $email): ?User;
    public function findByFirstnameAndLastname(string $firstname, string $lastname): array;
}