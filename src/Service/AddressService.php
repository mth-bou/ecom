<?php

namespace App\Service;

use App\Entity\Address;
use App\Repository\AddressRepositoryInterface;

class AddressService
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function getAllAddress(): array
    {
        return $this->addressRepository->findAll();
    }

    public function getAddressById(int $id): ?Address
    {
        return $this->addressRepository->find($id);
    }

    public function createAddress(Address $address): void
    {
        $this->addressRepository->save($address);
    }

    public function updateAddress(Address $address): void
    {
        $this->addressRepository->save($address);
    }

    public function deleteAddress(Address $address): void
    {
        $this->addressRepository->remove($address);
    }
}