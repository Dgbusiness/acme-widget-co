<?php

declare(strict_types=1);

namespace App\Offer;

use App\Product;

interface OfferInterface
{
    /**
     * Applies the offer to the given products.
     * @param array $products The list of products in the basket.
     * @return float The total discount amount.
     */
    public function apply(array $products): float;
}
