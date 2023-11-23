<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\DuplicateProductException;
use App\Interfaces\BasketInterface;
use App\Interfaces\ProductInterface;

class Basket implements BasketInterface
{
    private array $products = [];
    private $total = 0.00;
    private $subTotal = 0.00;

    public function addProduct(ProductInterface $product): void
    {
        if (array_key_exists($product->getProductCode(), $this->products) ) {
            throw new DuplicateProductException($product->getProductCode());
        }

        $this->products[$product->getProductCode()] = $product;
        $this->calculateTotals();
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSubTotal(): float 
    {
        return $this->subTotal;
       
    }

    public function getTotal(): float 
    {
        return $this->total;
    }

    public function calculateTotals(): void
    {   
        $subTotal = 0.00;
        foreach($this->products as $product) {
            $subTotal += $product->getPrice();
        }

        $this->subTotal = $subTotal;
        $this->total = $this->subTotal;
    }
}

