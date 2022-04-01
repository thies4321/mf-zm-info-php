<?php

declare(strict_types=1);

namespace MfZmInfo\Command\ZeroMission;

use MfZmInfo\Command\AbstractGetRomCodeMap;
use MfZmInfo\Exception\GameNotFoundException;
use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\ZeroMission;
use MfZmInfo\Model\RegionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'zm:map:romcode',
    description: 'Get ROM Code map for Metroid Zero Mission',
    hidden: false
)]
final class GetRomCodeMap extends AbstractGetRomCodeMap
{
    /**
     * @throws InvalidRegionException
     * @throws GameNotFoundException
     * @throws MissingVariableException
     * @throws ResourceNotFoundException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $region = $input->getArgument('region') ?? RegionInterface::REGION_USA;
        $this->game = new ZeroMission($region);

        return parent::execute($input, $output);
    }
}