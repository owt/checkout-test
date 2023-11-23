<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ItemNotFoundException;
use App\Interfaces\DataSourceInterface;
use App\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;

class OfferRepository implements OfferRepositoryInterface
{
    public function __construct(
        protected DataSourceInterface $dataSource
    ) {}

    public function getOffer(string $offerCode): ?Offer
    {
        if($offer = $this->dataSource->getOffer($offerCode)) {
            return new Offer(
                $offer->offerCode,
                $offer->name,
                $offer->discount
            );
        }

        throw new ItemNotFoundException($offerCode);
    }
}
