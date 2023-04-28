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

    public function getProductById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function createProduct(User $user): void
    {
        $this->userRepository->save($user);
    }

    public function updateProduct(User $user): void
    {
        $this->userRepository->save($user);
    }

    public function deleteProduct(User $user): void
    {
        $this->userRepository->remove($user);
    }
}