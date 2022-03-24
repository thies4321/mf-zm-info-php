<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

final class Struct extends AbstractStruct implements StructInterface
{
    public function __construct(
        string $type,
        string $size,
        array $variables
    ) {
        $this->validateVariables($variables);

        $this->type = $type;
        $this->size = $size;
        $this->variables = $variables;
    }

    public static function fromArray(array $struct): self
    {
        return new self(
            $struct['type'],
            $struct['size'],
            $struct['variables'],
        );
    }
}