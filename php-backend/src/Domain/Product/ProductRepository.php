<?php
namespace Domain\Product;

interface ProductRepository {
    /** @return Product[] */
    public function getAll(): array;
    public function saveMany(array $products): void;
}