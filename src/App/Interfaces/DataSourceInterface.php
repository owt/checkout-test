<?php
declare(strict_types=1);

namespace App\Interfaces;

interface DataSourceInterface {
    public function getProduct(string $productCode): ?Object;
    public function getOffer(string $offerCode): ?Object;
}
