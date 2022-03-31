<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\EnumRepository;

use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\EnumRepositoryInterface;
use function file_exists;
use function file_get_contents;
use function json_decode;
use function sprintf;

abstract class AbstractEnumRepository implements EnumRepositoryInterface
{
    protected GameInterface $game;

    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct(?GameInterface $game = null)
    {
        $this->game = $game ?? Fusion::usa();

        $path = sprintf('%s/../../../resources/%s/enums.json', __DIR__, $this->game->getShortName());

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forEnums($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}