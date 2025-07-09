<?php

declare(strict_types=1);

namespace App;

use App\Offer\OfferInterface;

class Basket
{
    private array $items = [];
    
    /**
     * Basket constructor.
     * @param array $catalogue  The list of available products.
     * @param DeliveryRule $deliveryRule  The delivery rule to apply.
     * @param array $offers  The list of offers to apply (optional).
     * @return void
     */
    public function __construct(
        private array $catalogue,
        private DeliveryRule $deliveryRule,
        private array $offers = [] 
    ) {}

    /**
     * Returns a hello message for the API.
     * @return string  The hello message.
     */
    public function hello(): string
    {
        return "Hello, API!";
    }

    /**
     * Adds a product to the basket by its code.
     * @param string $productCode  The code of the product to add.
     * @return void
     */
    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new \InvalidArgumentException("Product not found: $productCode");
        }
        $this->items[] = $this->catalogue[$productCode];
    }

    /**
     * Calculates the total price of the basket, including discounts and delivery.
     * @return float  The total price.
     */
    public function total(): float
    {
        $subtotal = array_reduce($this->items, fn($carry, $item) => $carry + $item->price, 0.0);

        $discount = array_reduce($this->offers, function ($carry, OfferInterface $offer) {
            return $carry + $offer->apply($this->items);
        }, 0.0);

        $delivery = $this->deliveryRule->getDeliveryCost($subtotal - $discount);

        return floor(($subtotal - $discount + $delivery) * 100) / 100; // Round to 2 decimal places;
    }
}
