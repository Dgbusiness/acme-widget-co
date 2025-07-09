<?php

declare(strict_types=1);

namespace App\Offer;

use App\Product;

class BogoHalfPrice implements OfferInterface
{
    private string $targetCode;

    /**
     * BogoHalfPrice constructor.
     * @param string $targetCode  The product code to which the offer applies.
     * @return void
     */
    public function __construct(string $targetCode)
    {
        $this->targetCode = $targetCode;
    }

    /**
     * Applies the Bogo Half Price offer to the given products.
     * @param array $products  The list of products in the basket.
     * @return float  The total discount amount.
     */
    public function apply(array $products): float
    {
        $matching = array_filter($products, fn($p) => $p->code === $this->targetCode);
        $count = count($matching);
        $discounted = intdiv($count, 2);
        if ($discounted === 0) return 0.0;
        return array_values($matching)[0]->price * 0.5 * $discounted;
    }
}
