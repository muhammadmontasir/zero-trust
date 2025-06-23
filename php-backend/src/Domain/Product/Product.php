<?php

namespace Domain\Product;

class Product {
    public function __construct(
        private string $name,
        private float $price,
        private int $quantity = 1
    ) {}

    public function totalPrice(): float {
        return $this->price * $this->quantity;
    }

    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getQuantity(): int { return $this->quantity; }
}
