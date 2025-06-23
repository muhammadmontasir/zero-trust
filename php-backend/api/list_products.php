<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Infrastructure\MySQL\MySQLProductRepository;
use Application\UseCases\ListProducts;

header('Content-Type: application/json');

try {
    $pdo = getPDO();
    $repo = new MySQLProductRepository($pdo);
    $useCase = new ListProducts($repo);
    $products = $useCase->execute();

    echo json_encode([
        'success' => true,
        'products' => array_map(fn($p) => [
            'name' => $p->getName(),
            'price' => $p->getPrice(),
            'quantity' => $p->getQuantity()
        ], $products)
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch products',
        'error' => $e->getMessage()
    ]);
}
