<?php
declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Services\Basket;
use App\Exceptions\DuplicateProductException;
use App\Models\Offer;
use App\Services\OfferCollection;

final class BasketTest extends TestCase
{
    private Product $photography;
    private Product $floorplan;
    private Product $gasCert;
    private Product $eicrCert;

    public function setUp(): void
    {
        $this->photography = new Product('P001', 'Photography', 200);
        $this->floorplan = new Product('P002', 'Floorplan', 100);
        $this->gasCert = new Product('P003', 'Gas Certificate', 83.50);
        $this->eicrCert = new Product('P004', 'EICR Certificate', 51.00);
    }

    public function testCanAddProductToBasket(): void
    {
        $basket = new Basket();

        $basket->addProduct($this->photography);

        $this->assertEquals(
            [$this->photography->getProductCode() => $this->photography],
            $basket->getProducts()
        );
        
        $this->assertEquals(
            200,
            $basket->getTotal()
        );
    }

    public function testCanAddMultipleProductsToBasket(): void
    {
        $basket = new Basket();

        $basket->addProduct($this->photography);
        $basket->addProduct($this->floorplan);

        $this->assertEquals(
            [
                $this->photography->getProductCode() => $this->photography, 
                $this->floorplan->getProductCode() => $this->floorplan
            ],
            $basket->getProducts()
        );
        
        $this->assertEquals(
            300,
            $basket->getTotal()
        );
    }

    public function testCanAddTheSameProductManyTimes(): void
    {
        $basket = new Basket();

        $this->expectException(DuplicateProductException::class);
        $basket->addProduct($this->photography);
        $basket->addProduct($this->photography);
    }

    public function testOffersCanBeAppliedToBasket(): void
    {
        $offerCollection = new OfferCollection();
        $offerCollection->addOffer(
            new Offer(
                '12months', 
                'Users who have agreed to a 12-month contract are entitled to a 10% discount off the basket total', 
                10
            )
        );
        $basket = new Basket($offerCollection);

        $basket->addProduct($this->photography);
        $basket->addProduct($this->floorplan);
        $basket->addProduct($this->gasCert);
        $basket->addProduct($this->eicrCert);

        $expectedSubTotal = 200 + 100 + 83.50 + 51.00;
        $expectedDiscount = $expectedSubTotal * 0.1;
        $expectedTotal = $expectedSubTotal - $expectedDiscount;

        $this->assertEquals(
            $expectedSubTotal,
            $basket->getSubtotal()
        );

        $this->assertEquals(
            $expectedDiscount,
            $basket->getDiscount()
        );

        $this->assertEquals(
            $expectedTotal,
            $basket->getTotal()
        );

    }
}

