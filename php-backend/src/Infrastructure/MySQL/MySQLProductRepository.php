<?php
namespace Infrastructure\MySQL;

use Domain\Product\Product;
use Domain\Product\ProductRepository;
use PDO;

class MySQLProductRepository implements ProductRepository {
    public function __construct(private PDO $pdo) {}

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT name, price, quantity FROM products");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) =>
            new Product($row['name'], (float)$row['price'], (int)$row['quantity']),
            $rows
        );
    }

    public function saveMany(array $products): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO products (name, price, quantity) VALUES (:name, :price, :quantity)"
        );

        foreach ($products as $product) {
            $stmt->execute([
                ':name'     => $product->getName(),
                ':price'    => $product->getPrice(),
                ':quantity' => $product->getQuantity()
            ]);
        }
    }
}
