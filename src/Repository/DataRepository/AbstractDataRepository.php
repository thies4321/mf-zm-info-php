<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\DataRepository;

use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\DataRepositoryInterface;

use function file_exists;
use function file_get_contents;
use function json_decode;
use function sprintf;

abstract class AbstractDataRepository implements DataRepositoryInterface
{
    protected GameInterface $game;

    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct(?GameInterface $game = null)
    {
        $this->game = $game ?? Fusion::usa();

        $path = sprintf('%s/../../../resources/%s/data.json', __DIR__, $this->game->getShortName());

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forData($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}