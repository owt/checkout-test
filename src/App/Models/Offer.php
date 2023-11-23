<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\OfferInterface;

class Offer implements OfferInterface
{
    private string $offerCode;
    private string $name;
    private float $discount;

    public function __construct(string $offerCode, string $name, float $discount)
    {
        $this->offerCode = $offerCode;
        $this->name = $name;
        $this->discount = $discount;
    }

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
