<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\User;
use App\Repository\AddressRepositoryInterface;

class AddressService
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function getAllAddresses(): array
    {
        return $this->addressRepository->findAll();
    }

    public function getAddressById(int $id): ?Address
    {
        return $this->addressRepository->find($id);
    }

    public function getAddressByIdAndUser(int $id, User $user): ?Address
    {
        return $this->addressRepository->findByIdAndUser($id, $user);
    }

    public function createAddress(Address $address): void
    {
        $this->addressRepository->save($address);
    }

    public function updateAddress(Address $address, ?array $fields): void
    {
        $this->addressRepository->edit($address, $fields);
    }

    public function deleteAddress(Address $address): void
    {
        $this->addressRepository->remove($address);
    }
}