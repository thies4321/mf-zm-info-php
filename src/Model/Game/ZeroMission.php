<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Game;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\GameInterface;

use function in_array;

final class ZeroMission extends AbstractGame implements GameInterface
{
    private const REGION_DATA_USA = [
        'sha1' => '5de8536afe1f0078ee6fe1089f890e8c7aa0a6e8',
        'md5' => 'ebbce58109988b6da61ebb06c7a432d5',
        'crc' => '5c61a844',
    ];

    private const REGION_DATA_EUR = [
        'sha1' => '0fd107445a42e6f3a3e5ce8c865f412583179903',
        'md5' => '07930e72d4824bd63827a1a823cc8829',
        'crc' => '8388608',
    ];

    private const REGION_DATA_JAP = [
        'sha1' => '096f07685a3dc9286e71aa0b761f233b5efa2fcd',
        'md5' => '650140ccae6e1ab7af44c74986002375',
        'crc' => '44b79e2b',
    ];

    private const REGION_DATA_MAPPING = [
        self::REGION_USA => self::REGION_DATA_USA,
        self::REGION_EUR => self::REGION_DATA_EUR,
        self::REGION_JAP => self::REGION_DATA_JAP,
    ];

    /**
     * @throws InvalidRegionException
     */
    public function __construct(string $region = self::REGION_USA)
    {
        if (! in_array($region, self::REGIONS)) {
            throw InvalidRegionException::forRegion($region);
        }

        $name = 'Metroid: Zero Mission';
        $shortName = 'zm';

        $regionData = self::REGION_DATA_MAPPING[$region];

        $sha1 = $regionData['sha1'];
        $md5 = $regionData['md5'];
        $crc = $regionData['crc'];

        parent::__construct($name, $shortName, $sha1, $md5, $crc, $region);
    }

    public static function usa(): self
    {
        return new self(self::REGION_USA);
    }

    public static function eur(): self
    {
        return new self(self::REGION_EUR);
    }

    public static function jap(): self
    {
        return new self(self::REGION_JAP);
    }
}
