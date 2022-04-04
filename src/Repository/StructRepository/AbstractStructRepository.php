<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\StructRepository;

use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\EnumRepository\EnumRepository;
use MfZmInfo\Repository\EnumRepositoryInterface;
use MfZmInfo\Repository\StructRepositoryInterface;

use function file_exists;
use function file_get_contents;
use function json_decode;
use function sprintf;

abstract class AbstractStructRepository implements StructRepositoryInterface
{
    protected GameInterface $game;

    protected EnumRepositoryInterface $enumRepository;

    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct(?GameInterface $game = null, ?EnumRepositoryInterface $enumRepository = null)
    {
        $this->game = $game ?? Fusion::usa();
        $this->enumRepository = $enumRepository ?? new EnumRepository();

        $path = sprintf('%s/../../../resources/%s/structs.json', __DIR__, $this->game->getShortName());

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forStructs($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}
