<?php

declare(strict_types=1);

namespace MfZmInfo\Service;

use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Model\Struct\Struct;
use MfZmInfo\Repository\StructRepository\StructRepository;
use MfZmInfo\Repository\StructRepositoryInterface;

use function dechex;
use function intval;
use function strtoupper;

final class LengthConverterService
{
    private StructRepositoryInterface $structRepository;

    public function __construct(?GameInterface $game = null, ?StructRepositoryInterface $structRepository = null)
    {
        $this->structRepository = $structRepository ?? new StructRepository($game);
    }

    /**
     * @throws MissingVariableException
     */
    public function getHexadecimalLength(?string $size, ?string $type, ?string $count): string
    {
        $length = $this->getLength($size, $type, $count);
        return strtoupper(dechex($length));
    }

    /**
     * @throws MissingVariableException
     */
    public function getLength(?string $size, ?string $type, ?string $count): int
    {
        return $this->getSize($size, $type) * $this->getCount($count);
    }

    /**
     * @throws MissingVariableException
     */
    private function getSize(?string $size = null, ?string $type = null): ?int
    {
        if ($size !== null) {
            return $this->getHexValue($size);
        }

        $struct = $this->structRepository->getByType($type ?? '');

        if ($struct instanceof Struct) {
            return $this->getHexValue($struct->getSize());
        }

        return PrimitiveTypesService::getSize($type);
    }

    private function getCount(?string $count = null): int
    {
        if ($count !== null) {
            return intval($count, 16);
        }

        return 1;
    }

    private function getHexValue(string $size): int
    {
        return intval($size, 16);
    }
}
