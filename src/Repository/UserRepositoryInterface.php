<?php

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user, bool $flush = false): void;
    public function remove(User $user, bool $flush = false): void;
    public function edit(User $user, array $fields): void;
    public function findByEmail(string $email): ?User;
    public function findByLastname(string $lastname): array;
    public function findByEmailAndPassword(string $email, string $password): ?User;
}