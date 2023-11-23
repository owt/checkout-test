<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\DuplicateProductException;
use App\Interfaces\BasketInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\OfferCollectionInterface;

class Basket implements BasketInterface
{
    private array $products = [];
    private OfferCollection $offerCollection;
    private $total = 0.00;
    private $subTotal = 0.00;
    private $discount = 0.00;

    public function __construct(?OfferCollectionInterface $offerCollection = null)
    {
        if($offerCollection === null) {
            $this->offerCollection = new OfferCollection();
        } else {
            $this->offerCollection = $offerCollection;
        }
    }

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

    public function getDiscount(): float 
    {
        return $this->discount;
    }

    public function calculateTotals(): void
    {   
        $subTotal = 0.00;
        foreach($this->products as $product) {
            $subTotal += $product->getPrice();
        }

        $this->subTotal = $subTotal;
        $this->discount = $this->offerCollection->getDiscount($this->subTotal);
        $this->total = $this->subTotal - $this->getDiscount();
    }
}
