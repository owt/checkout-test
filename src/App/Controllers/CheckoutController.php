<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\ItemNotFoundException;
use App\Exceptions\DuplicateProductException;
use App\Interfaces\BasketInterface;
use App\Services\Basket;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\OfferRepositoryInterface;
use App\Services\OfferCollection;

class CheckoutController
{
    private BasketInterface $basket;
    private array $errors = [];

    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private OfferRepositoryInterface $offerRepository,
    ) {}

    public function index(): string
    {
        $offerCollection = new OfferCollection();

        try {
            $offer = $this->offerRepository->getOffer('12MONTHS');
            $offerCollection->addOffer($offer);
        } catch (ItemNotFoundException $e) {
            $this->errors[] = $e->getMessage();
        }
        

        $this->basket = new Basket($offerCollection);

        $this->addItemToBasket('P001');
        $this->addItemToBasket('P002');

        $output = '';
        if(count($this->errors) > 0) {
            $output .= implode("\n", $this->errors);
        }
        $output .= "Products:\n";
        foreach($this->basket->getProducts() as $product) {
            $output .= "{$product->getName()} - {$product->getPrice()}\n";
        }
        $output .= "\n";
        $output .= "Sub total: {$this->basket->getSubTotal()}\nDiscount: {$this->basket->getDiscount()}\nTotal: {$this->basket->getTotal()}\n";

        return $output;
    }

    public function addItemToBasket(string $productCode): void {
        try {
            $product = $this->productRepository->getProduct($productCode);
            $this->basket->addProduct($product);
        } catch (ItemNotFoundException $e) {
            $this->errors[] = $e->getMessage();
        } catch (DuplicateProductException $e) {
            $this->errors[] = $e->getMessage();
        }
    }
}
