<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Game;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\GameInterface;

use function in_array;

final class Fusion extends AbstractGame implements GameInterface
{
    private const REGION_DATA_USA = [
        'sha1' => 'ca33f4348c2c05dd330d37b97e2c5a69531dfe87',
        'md5' => 'af5040fc0f579800151ee2a683e2e5b5',
        'crc' => '6c75479c',
    ];

    private const REGION_DATA_EUR = [
        'sha1' => 'cc46d54b70c1ee38c856ee6e58ec712136763389',
        'md5' => 'eb462f708c715309d08fd7968825ae9e',
        'crc' => '974e46ab',
    ];

    private const REGION_DATA_JAP = [
        'sha1' => '5d21c668baa84da4a5b745be56809bb277f947a3',
        'md5' => 'e535a6ec2eb86d183453037289527a63',
        'crc' => '817a7e9e',
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

        $name = 'Metroid: Fusion';
        $shortName = 'mf';

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
