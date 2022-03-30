<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Ram;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\RamInterface;

final class Ram extends AbstractRam implements RamInterface
{
    /**
     * @throws InvalidRegionException
     */
    public function __construct(
        string $description,
        string $label,
        ?string $size,
        ?string $type,
        string $address,
        ?string $count,
        ?string $enum,
        string $region
    ) {
        $this->description = $description;
        $this->label = $label;
        $this->size = $size;
        $this->type = $type;
        $this->address = $address;
        $this->count = $count;
        $this->enum = $enum;

        parent::__construct($region);
    }

    /**
     * @throws InvalidRegionException
     */
    public static function fromArray(array $ram): self
    {
        return new self(
            $ram['description'],
            $ram['label'],
            $ram['size'],
            $ram['type'],
            $ram['address'],
            $ram['count'],
            $ram['enum'],
            $ram['region']
        );
    }
}
