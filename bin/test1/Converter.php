<?php
declare(strict_types=1);

require 'Unit.php';

/**
 * Class Converter
 */
class Converter
{
    /**
     * @var SplFixedArray
     */
    private $units;

    /**
     * @var float
     */
    public $factor = 1.0;

    /**
     * Converter constructor.
     *
     * @param SplFixedArray $units
     */
    public function __construct(SplFixedArray $units)
    {
        $this->units = $units;
    }

    /**
     * @param Unit $originUnit
     * @param Unit $targetUnit
     */
    public function convertUnit(Unit $originUnit, Unit $targetUnit): void
    {
        if ($targetUnit->referenceUnit === $originUnit->id) {
            $this->factor /= $targetUnit->quantity;
            return;
        }

        /** @var Unit $unit */
        foreach ($this->units as $unit) {
            if ($unit->id === $originUnit->referenceUnit) {
                if (! is_null($originUnit->quantity)) {
                    $this->factor *= $originUnit->quantity;
                    $this->convertUnit($unit, $targetUnit);
                }
            }
        }
    }
}
