<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Interfaces\OfferInterface;

interface OfferRepositoryInterface {
    public function __construct(DataSourceInterface $db);
    public function getOffer(string $offerCode): ?OfferInterface;
}
