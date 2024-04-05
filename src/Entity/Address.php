<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'addresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $address;

     #[ORM\Column(type: 'string', length: 255)]
    private ?string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $country;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $number;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'shippingAddress')]
    private Collection $ordersShippingAddress;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'billingAddress')]
    private Collection $ordersBillingAddress;

    public function __construct()
    {
        $this->ordersShippingAddress = new ArrayCollection();
        $this->ordersBillingAddress = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrdersShippingAddress(): Collection
    {
        return $this->ordersShippingAddress;
    }

    public function addOrdersShippingAddress(Order $ordersShippingAddress): static
    {
        if (!$this->ordersShippingAddress->contains($ordersShippingAddress)) {
            $this->ordersShippingAddress->add($ordersShippingAddress);
            $ordersShippingAddress->setShippingAddress($this);
        }

        return $this;
    }

    public function removeOrdersShippingAddress(Order $ordersShippingAddress): static
    {
        if ($this->ordersShippingAddress->removeElement($ordersShippingAddress)) {
            // set the owning side to null (unless already changed)
            if ($ordersShippingAddress->getShippingAddress() === $this) {
                $ordersShippingAddress->setShippingAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrdersBillingAddress(): Collection
    {
        return $this->ordersBillingAddress;
    }

    public function addOrdersBillingAddress(Order $ordersBillingAddress): static
    {
        if (!$this->ordersBillingAddress->contains($ordersBillingAddress)) {
            $this->ordersBillingAddress->add($ordersBillingAddress);
            $ordersBillingAddress->setBillingAddress($this);
        }

        return $this;
    }

    public function removeOrdersBillingAddress(Order $ordersBillingAddress): static
    {
        if ($this->ordersBillingAddress->removeElement($ordersBillingAddress)) {
            // set the owning side to null (unless already changed)
            if ($ordersBillingAddress->getBillingAddress() === $this) {
                $ordersBillingAddress->setBillingAddress(null);
            }
        }

        return $this;
    }
}
