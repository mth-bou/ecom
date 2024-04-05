<?php

namespace App\Service;

use App\Repository\UserRepositoryInterface;
use App\Entity\User;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function getUsersByFirstnameAndLastname(string $firstname, string $lastname): array
    {
        return $this->userRepository->findByFirstnameAndLastname($firstname, $lastname);
    }

    public function createUser(User $user): void
    {
        $this->userRepository->save($user);
    }

    public function updateUser(User $user, ?array $fields): void
    {
        $this->userRepository->edit($user, $fields);
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->remove($user);
    }
}