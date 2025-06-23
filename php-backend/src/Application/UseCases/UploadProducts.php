<?php
namespace Application\UseCases;

use Domain\Product\Product;
use Domain\Product\ProductRepository;

class UploadProducts {
    public function __construct(private ProductRepository $repo) {}

    public function execute(array $data): void {
        $products = [];

        foreach ($data as $row) {
            if (isset($row['name'], $row['price'])) {
                $products[] = new Product(
                    $row['name'],
                    (float)$row['price'],
                    isset($row['quantity']) ? (int)$row['quantity'] : 1
                );
            }
        }

        $this->repo->saveMany($products);
    }
}
