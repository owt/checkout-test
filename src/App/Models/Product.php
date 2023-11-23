<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\ProductInterface;

class Product implements ProductInterface
{
    private string $productCode;
    private string $name;
    private float $price;

    public function __construct(string $productCode, string $name, float $price)
    {
        $this->productCode = $productCode;
        $this->name = $name;
        $this->price = $price;
    }

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
