<?php
declare(strict_types=1);

namespace App\Model;

/**
 * Class Category
 *
 * @package App\Model
 */
class Category
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $path;

    /**
     * Category constructor.
     *
     * @param string $name
     * @param string|null $path
     */
    public function __construct(string $name, ?string $path = null)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
