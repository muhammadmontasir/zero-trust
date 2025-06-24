<?php

require_once __DIR__ . '/../config/db.php';

use Infrastructure\MySQL\MySQLProductRepository;
use Application\UseCases\CalculateTotalPrice;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

spl_autoload_register(function ($class) {
    $base = __DIR__ . '/../src/';
    $path = $base . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) require_once $path;
});

try {
    $pdo = getPDO();
    $repo = new MySQLProductRepository($pdo);
    $useCase = new CalculateTotalPrice($repo);
    $total = $useCase->execute();

    echo json_encode([
        'success' => true,
        'total_price' => number_format($total, 2)
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to calculate total.',
        'error' => $e->getMessage()
    ]);
}
