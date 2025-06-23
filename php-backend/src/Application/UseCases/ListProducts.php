<?php
namespace Application\UseCases;

use Domain\Product\ProductRepository;

class ListProducts {
    public function __construct(private ProductRepository $repo) {}

    public function execute(): array {
        return $this->repo->getAll();
    }
}
