<?php
namespace Application\UseCases;

use Domain\Product\ProductRepository;

class CalculateTotalPrice {
    public function __construct(private ProductRepository $repo) {}

    public function execute(): float {
        $products = $this->repo->getAll();
        return array_reduce($products, fn($carry, $p) => $carry + $p->totalPrice(), 0.0);
    }
}
