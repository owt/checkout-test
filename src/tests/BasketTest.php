<?php
declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Services\Basket;
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
}
