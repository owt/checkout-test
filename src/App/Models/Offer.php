<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\OfferInterface;

class Offer implements OfferInterface
{
    public function __construct(
        protected string $offerCode,
        protected string $name,
        protected float $discount
    ) {}

    public function getOfferCode(): string { 
        return $this->offerCode;
    }

    public function getName(): string { 
        return $this->name;
    }

    public function getDiscount(): float { 
        return $this->discount;
    }

    public function getDiscountAmount(float $price): float {
        return ($price * ($this->discount/100));
    }
}
