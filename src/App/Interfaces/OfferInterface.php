<?php
declare(strict_types=1);

namespace App\Interfaces;

interface OfferInterface
{
    public function __construct(string $offerCode, string $name, float $discount);
    public function getOfferCode(): string;
    public function getName(): string;
    public function getDiscount(): float;
    public function getDiscountAmount(float $price): float;
}
