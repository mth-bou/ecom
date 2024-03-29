<?php

namespace App\Service;

use App\Repository\UserRepositoryInterface2;
use App\Entity\User2;

class UserService
{
    private UserRepositoryInterface2 $userRepository;

    public function __construct(UserRepositoryInterface2 $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getProductById(int $id): ?User2
    {
        return $this->userRepository->find($id);
    }

    public function createProduct(User2 $user): void
    {
        $this->userRepository->save($user);
    }

    public function updateProduct(User2 $user): void
    {
        $this->userRepository->save($user);
    }

    public function deleteProduct(User2 $user): void
    {
        $this->userRepository->remove($user);
    }
}