<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Data;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\DataInterface;

final class Data extends AbstractData implements DataInterface
{
    /**
     * @throws InvalidRegionException
     */
    public function __construct(
        string $description,
        string $label,
        ?string $type,
        string $address,
        ?string $count,
        ?string $size,
        string $region
    ) {
        $this->description = $description;
        $this->label = $label;
        $this->type = $type;
        $this->address = $address;
        $this->count = $count;
        $this->size = $size;

        parent::__construct($region);
    }

    /**
     * @throws InvalidRegionException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['description'],
            $data['label'],
            $data['type'],
            $data['address'],
            $data['count'],
            $data['size'],
            $data['region'],
        );
    }
}
