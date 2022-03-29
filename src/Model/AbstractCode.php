<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

use MfZmInfo\Exception\InvalidRegionException;

use MfZmInfo\Exception\InvalidVariableTypeException;
use MfZmInfo\Exception\MissingVariableException;
use function array_key_exists;
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

    /**
     * @throws MissingVariableException
     */
    protected function validateParameters(array $parameters): void
    {
        foreach ($parameters as $parameter) {
            if (! array_key_exists('description', $parameter)) {
                throw MissingVariableException::forDescription();
            }

            if (! array_key_exists('type', $parameter)) {
                throw MissingVariableException::forType();
            }
        }
    }

    protected function validateReturn(array $returns): void
    {
        foreach ($returns as $return) {
            foreach ($return as $key => $value) {
                if (! in_array($key, ['description', 'type', 'enum'])) {
                    throw new InvalidVariableTypeException();
                }
            }
        }
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
