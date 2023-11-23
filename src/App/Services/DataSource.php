<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\DataSourceInterface;

class DataSource implements DataSourceInterface
{

    private $products = [
        'P001' => ['productCode' => 'P001', 'name' => 'Photography', 'price' => 200],
        'P002' => ['productCode' => 'P002', 'name' => 'Floorplan', 'price' => 100],
        'P003' => ['productCode' => 'P003', 'name' => 'Gas Certificate', 'price' => 83.50],
        'P004' => ['productCode' => 'P004', 'name' => 'EICR Certificate', 'price' => 51.00],
    ];

    private $offers = [
        '12MONTHS' => [
            'offerCode' => '12MONTHS',
            'name' => 'Users who have agreed to a 12-month contract are entitled to a 10% discount off the basket total',
            'discount' => 10
        ],
    ];

    public function getProduct(string $productCode): ?Object
    {
        if(array_key_exists($productCode, $this->products)) {
            
            return (object) $this->products[$productCode];
        }

        return null;
    }

    public function getOffer(string $offerCode): ?Object
    {
        if(array_key_exists($offerCode, $this->offers)) {
            return (object) $this->offers[$offerCode];
        }
        
        return null;
    }
}
