<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Infrastructure\MySQL\MySQLProductRepository;
use Application\UseCases\UploadProducts;

header('Content-Type: application/json');

try {
    if (!isset($_FILES['file'])) {
        throw new Exception("No file uploaded");
    }

    $filePath = $_FILES['file']['tmp_name'];
    $rows = [];

    if (($handle = fopen($filePath, 'r')) !== false) {
        $headers = fgetcsv($handle);
        while (($data = fgetcsv($handle)) !== false) {
            $rows[] = array_combine($headers, $data);
        }
        fclose($handle);
    }

    $pdo = getPDO();
    $repo = new MySQLProductRepository($pdo);
    $useCase = new UploadProducts($repo);
    $useCase->execute($rows);

    echo json_encode([
        'success' => true,
        'message' => 'Products uploaded successfully'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Upload failed',
        'error' => $e->getMessage()
    ]);
}
