<?php
declare(strict_types=1);

namespace App\Interfaces;

interface OfferCollectionInterface
{
    public function addOffer(OfferInterface $offer): void;
    public function getOffers(): array;
    public function calculateDiscount(float $subTotal): float;
}
