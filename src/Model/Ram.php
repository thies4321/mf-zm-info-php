<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

use MfZmInfo\Exception\InvalidRegionException;

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
        ?string $count,
        ?string $enum,
        string $region
    ) {
        $this->description = $description;
        $this->label = $label;
        $this->size = $size;
        $this->type = $type;
        $this->count = $count;
        $this->enum = $enum;

        parent::__construct($region);
    }

    /**
     * @throws InvalidRegionException
     */
    public function fromArray(array $ram): self
    {
        return new self(
            $ram['description'],
            $ram['label'],
            $ram['size'],
            $ram['type'],
            $ram['count'],
            $ram['enum'],
            $ram['region']
        );
    }
}
