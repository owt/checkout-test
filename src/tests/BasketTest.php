<?php
declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Services\Basket;
use App\Exceptions\DuplicateProductException;
use App\Exceptions\ItemNotFoundException;
use App\Models\Offer;
use App\Services\OfferCollection;
use tests\FakeDataSource;
use App\Services\ProductRepository;
use App\Services\OfferRepository;

final class BasketTest extends TestCase
{
    private Product $photography;
    private Product $floorplan;
    private Product $gasCert;
    private Product $eicrCert;

    private $productRepository;
    private $offerRepository;

    public function setUp(): void
    {
        $this->productRepository = new ProductRepository(new FakeDataSource);
        $this->offerRepository = new OfferRepository(new FakeDataSource);


        $this->photography = new Product('P001', 'Photography', 200);
        $this->floorplan = new Product('P002', 'Floorplan', 100);
        $this->gasCert = new Product('P003', 'Gas Certificate', 83.50);
        $this->eicrCert = new Product('P004', 'EICR Certificate', 51.00);
    }

    public function testCanAddProductToBasket(): void
    {
        $basket = new Basket();

        $photography = $this->productRepository->getProduct('P001');
        $basket->addProduct($photography);

        $this->assertEquals(
            [$photography->getProductCode() => $photography],
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

        $photography = $this->productRepository->getProduct('P001');
        $floorplan = $this->productRepository->getProduct('P002');

        $basket->addProduct($photography);
        $basket->addProduct($floorplan);

        $this->assertEquals(
            [
                $photography->getProductCode() => $photography, 
                $floorplan->getProductCode() => $floorplan
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
        $basket->addProduct($this->productRepository->getProduct('P001'));
        $basket->addProduct($this->productRepository->getProduct('P001'));
    }

    public function testProductDoesNotExist(): void
    {
        $basket = new Basket();

        $this->expectException(ItemNotFoundException::class);
        $basket->addProduct($this->productRepository->getProduct('P005'));
    }

    public function testOffersCanBeAppliedToBasket(): void
    {
        $offerCollection = new OfferCollection();

        $offerCollection->addOffer($this->offerRepository->getOffer('12MONTHS'));
        $basket = new Basket($offerCollection);

        $basket->addProduct($this->productRepository->getProduct('P001'));
        $basket->addProduct($this->productRepository->getProduct('P002'));
        $basket->addProduct($this->productRepository->getProduct('P003'));
        $basket->addProduct($this->productRepository->getProduct('P004'));

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
