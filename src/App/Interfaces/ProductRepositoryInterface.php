<?php
declare(strict_types=1);

namespace App\Interfaces;

interface ProductRepositoryInterface {
    public function __construct(DataSourceInterface $productDataSource);
    public function getProduct(string $productCode): ?ProductInterface;
}
