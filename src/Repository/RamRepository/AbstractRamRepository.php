<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\RamRepository;

use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\RamRepositoryInterface;

use function file_exists;
use function file_get_contents;
use function json_decode;
use function sprintf;

abstract class AbstractRamRepository implements RamRepositoryInterface
{
    protected GameInterface $game;

    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct(?GameInterface $game = null)
    {
        $this->game = $game ?? Fusion::usa();

        $path = sprintf('%s/../../../resources/%s/ram.json', __DIR__, $this->game->getShortName());

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forData($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}
