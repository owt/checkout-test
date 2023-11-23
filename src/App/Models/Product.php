<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\ProductInterface;

class Product implements ProductInterface
{
    public function __construct(
        protected string $productCode,
        protected string $name,
        protected float $price
    ) {}

    public function getProductCode(): string { 
        return $this->productCode;
    }

    public function getName(): string { 
        return $this->name;
    }

    public function getPrice(): float { 
        return $this->price;
    }
}
