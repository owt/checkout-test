<?php
declare(strict_types=1);

namespace App\Interfaces;

interface ProductInterface {
    public function __construct(string $productCode, string $name, float $price);
    public function getProductCode(): string;
    public function getName(): string;
    public function getPrice(): float;
}
