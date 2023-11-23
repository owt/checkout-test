<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\DataSourceInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Exceptions\ItemNotFoundException;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(protected DataSourceInterface $dataSource) {}

    public function getProduct(string $productCode): ?Product
    {
        if($product = $this->dataSource->getProduct($productCode)) {
            return new Product(
                $product->productCode,
                $product->name,
                $product->price
            );
        }

        throw new ItemNotFoundException($productCode);
    }
}
