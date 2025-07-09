<?php

declare(strict_types=1);

namespace App;

class DeliveryRule
{
    public function __construct(private array $thresholds) {}

    /**
     * Calculates the delivery cost based on the given subtotal.
     * @param float $subtotal The subtotal amount to evaluate.
     * @return float  The delivery cost for the given subtotal.
     */
    public function getDeliveryCost(float $subtotal): float
    {
        foreach ($this->thresholds as $threshold => $cost) {
            if ($subtotal < $threshold) {
                return $cost;
            }
        }
        return 0.0;
    }
}
