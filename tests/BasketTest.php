<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\{Basket, Product, DeliveryRule};
use App\Offer\BogoHalfPrice;

class BasketTest extends TestCase
{
    private array $catalogue;

    /**
     * Initializes the product catalogue before each test.
     * @return void
     */
    protected function setUp(): void
    {
        $this->catalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];
    }

    /**
     * Checks that the hello() method of Basket responds correctly.
     * @return void
     */
    public function test_api_listening(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );
        $this->assertSame('Hello, API!', $basket->hello());
    }

    /**
     * Verifies the total calculation of the basket with some products.
     * @return void
     */
    public function test_example_basket(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );

        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }

    /**
     * Checks that the BogoHalfPrice offer is correctly applied to Red Widget - R01.
     * @return void
     */
    public function test_red_widget_offer_applies(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );

        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(54.37, $basket->total());
    }

    /**
     * Tests the total for example basket 1.
     * @return void
     */
    public function test_example_basket_1(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());
    }

    /**
     * Tests the total for example basket 2.
     * @return void
     */
    public function test_example_basket_2(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());
    }

    /**
     * Tests the total for example basket 3.
     * @return void
     */
    public function test_example_basket_3(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());
    }

    /**
     * Tests the total for example basket 4.
     * @return void
     */
    public function test_example_basket_4(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }

    /**
     * Tests that adding an invalid product code throws an exception.
     * @return void
     */
    public function test_add_invalid_product_code_throws_exception(): void
    {
        $basket = new Basket(
            $this->catalogue,
            new DeliveryRule([50 => 4.95, 90 => 2.95]),
            [new BogoHalfPrice('R01')]
        );

        $this->expectException(\InvalidArgumentException::class);
        $basket->add('INVALID_CODE');
    }
}
