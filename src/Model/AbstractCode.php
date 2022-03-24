<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

use MfZmInfo\Exception\InvalidRegionException;
use function in_array;

abstract class AbstractCode implements CodeInterface, RegionInterface
{
    protected string $description;

    protected string $label;

    protected string $address;

    protected string $size;

    protected string $mode;

    protected array $parameters;

    protected array $return;

    protected ?string $notes;

    protected string $region;

    protected function validateParameters(array $parameters): void
    {
        
    }

    /**
     * @throws InvalidRegionException
     */
    public function __construct(string $region)
    {
        if (! in_array($region, self::REGIONS)) {
            throw InvalidRegionException::forRegion($region);
        }

        $this->region = $region;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getReturn(): array
    {
        return $this->return;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}
