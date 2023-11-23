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

    public function calculateDiscount(float $subTotal): float
    {
        return 0.00;
    }
}
