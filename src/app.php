<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\Services\DataSource;
use App\Services\ProductRepository;
use App\Services\OfferRepository;
use App\Controllers\CheckoutController;

$productRepository = new ProductRepository(new DataSource());
$offerRepository = new OfferRepository(new DataSource());

$controller = new CheckoutController($productRepository, $offerRepository);
echo $controller->index();