<?php

namespace App\Repository;

use App\Entity\Address;
use App\Entity\User;

interface AddressRepositoryInterface
{
    public function save(Address $address): void;
    public function remove(Address $address): void;
    public function edit(Address $address, ?array $fields): void;
    public function findByIdAndUser(int $id, User $user): ?Address;
}