<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

use MfZmInfo\Exception\InvalidRegionException;
use function array_key_exists;

final class Code extends AbstractCode implements CodeInterface
{
    /**
     * @throws InvalidRegionException
     */
    public function __construct(
        string $description,
        string $label,
        string $address,
        string $size,
        string $mode,
        array $parameters,
        array $return,
        ?string $notes,
        string $region
    ) {
        $this->description = $description;
        $this->label = $label;
        $this->address = $address;
        $this->size = $size;
        $this->mode = $mode;
        $this->parameters = $parameters;
        $this->return = $return;
        $this->notes = $notes;

        parent::__construct($region);
    }

    /**
     * @throws InvalidRegionException
     */
    public static function fromArray(array $code): self
    {
        return new self(
            $code['description'],
            $code['label'],
            $code['address'],
            $code['size'],
            $code['mode'],
            $code['parameters'],
            $code['return'],
            $code['notes'],
            $code['region'],
        );
    }
}
