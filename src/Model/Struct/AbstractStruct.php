<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Struct;

use MfZmInfo\Exception\InvalidVariableTypeException;
use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Model\StructInterface;
use function array_key_exists;
use function gettype;
use function is_string;

abstract class AbstractStruct implements StructInterface
{
    protected string $type;

    protected string $size;

    protected array $variables;

    /**
     * @throws MissingVariableException
     */
    protected function validateVariables(array $variables): void
    {
        foreach ($variables as $variable) {
            if (! array_key_exists('description', $variable)) {
                throw MissingVariableException::forDescription();
            }

            if (! is_string($variable['description'])) {
                throw InvalidVariableTypeException::forDescription('string', gettype($variable['description']));
            }

            if (! array_key_exists('offset', $variable)) {
                throw MissingVariableException::forOffset();
            }

            if (! is_string($variable['offset'])) {
                throw InvalidVariableTypeException::forOffset('string', gettype($variable['offset']));
            }

            if (array_key_exists('type', $variable)) {
                if (! is_string($variable['type'])) {
                    throw InvalidVariableTypeException::forType('string', gettype($variable['type']));
                }
            }

            if (array_key_exists('enum', $variable)) {
                if (! is_string($variable['enum'])) {
                    throw InvalidVariableTypeException::forEnum('string', gettype($variable['enum']));
                }
            }
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }
}