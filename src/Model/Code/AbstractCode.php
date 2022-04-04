<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Code;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Exception\InvalidVariableTypeException;
use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Model\CodeInterface;
use MfZmInfo\Model\RegionInterface;

use function array_key_exists;
use function in_array;
use function is_a;
use function is_array;
use function print_r;

abstract class AbstractCode implements CodeInterface
{
    protected string $description;

    protected string $label;

    protected string $address;

    protected string $size;

    protected string $mode;

    /**
     * @var array<string, array<string>>
     */
    protected array $parameters;

    /**
     * @var array<string, array<string>>
     */
    protected array $return;

    protected ?string $notes;

    protected string $region;

    /**
     * @param array<string, array<string>> $parameters
     *
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

    /**
     * @param array<string> $returns
     */
    protected function validateReturn(array $returns): void
    {
        foreach ($returns as $key => $return) {
            if (! in_array($key, ['description', 'type', 'enum'])) {
                throw new InvalidVariableTypeException();
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

    /**
     * @return string[][]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return string[][]
     */
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
