<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Models\Product;
use App\Services\Basket;
use App\Services\OfferCollection;
use App\Models\Offer;

$offerCollection = new OfferCollection();
$offerCollection->addOffer(
    new Offer(
        '12months', 
        'Users who have agreed to a 12-month contract are entitled to a 10% discount off the basket total', 
        10
    )
);
$basket = new Basket($offerCollection);
$photography = new Product('P001', 'Photography', 200);
$floorplan = new Product('F001', 'Floorplan', 100);

$basket->addProduct($photography);
$basket->addProduct($floorplan);

foreach($basket->getProducts() as $product) {
    echo $product->getName() . ' - ' . $product->getPrice() . "\n";
}

echo "\n";
echo 'sub total: ' . $basket->getSubTotal() . "\n";
echo 'discount: ' . $basket->getDiscount() . "\n";
echo 'total: ' . $basket->getTotal() . "\n";

echo "\n";
