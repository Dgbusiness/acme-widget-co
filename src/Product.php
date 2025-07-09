<?php

declare(strict_types=1);

namespace App;

/**
 * Product constructor.
 * @param string $code  The product code.
 * @param string $name  The product name.
 * @param float $price  The product price.
 * @return void
 */
class Product
{
    public function __construct(
        public string $code,
        public string $name,
        public float $price
    ) {}
}
