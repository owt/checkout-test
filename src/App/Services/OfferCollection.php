<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\OfferCollectionInterface;
use App\Interfaces\OfferInterface;

class OfferCollection implements OfferCollectionInterface
{
    private $offers = [];

    public function addOffer(OfferInterface $offer): void
    {
        $this->offers[$offer->getOfferCode()] = $offer;
    }

    public function getOffers(): array
    {
        return $this->offers;
    }

    public function getDiscount(float $subTotal): float
    {
        $totalDiscountAmount = 0.00;

        // Total up discounts
        foreach($this->offers as $offer) {
            $discountAmount = $offer->getDiscountAmount($subTotal);
            $totalDiscountAmount += $discountAmount;
        }

        return $totalDiscountAmount;
    }
}
