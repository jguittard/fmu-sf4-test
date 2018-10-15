<?php
declare(strict_types=1);

/**
 * Class Unit
 */
class Unit
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $quantity;

    /**
     * @var string
     */
    public $referenceUnit;

    /**
     * Unit constructor.
     *
     * @param string $id
     * @param string $name
     * @param float $quantity
     * @param string $referenceUnit
     */
    public function __construct(string $id, string $name, ?float $quantity, ?string $referenceUnit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->referenceUnit = $referenceUnit;
    }
}
