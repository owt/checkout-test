<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Interfaces\ProductInterface;

interface BasketInterface {
    public function addProduct(ProductInterface $product): void;
    public function getProducts(): array;
    public function getSubtotal(): float;
    public function getTotal(): float;
}
