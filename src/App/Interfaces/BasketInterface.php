<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Interfaces\ProductInterface;
use App\Interfaces\OfferCollectionInterface;

interface BasketInterface {
    public function __construct(?OfferCollectionInterface $offerCollection);
    public function addProduct(ProductInterface $product): void;
    public function getProducts(): array;
    public function getSubtotal(): float;
    public function getDiscount(): float;
    public function getTotal(): float;
}
