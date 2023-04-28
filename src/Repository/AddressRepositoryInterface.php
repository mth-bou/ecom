<?php

namespace App\Repository;

use App\Entity\Address;

interface AddressRepositoryInterface
{
    public function save(Address $address): void;
    public function remove(Address $address): void;
    public function edit(Address $address, array $fields, bool $flush = false): void;
    public function findById(int $id): ?Address;
    public function findByIdAndUserId(int $id, int $userId): ?Address;
}