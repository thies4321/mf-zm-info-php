<?php

declare(strict_types=1);

namespace MfZmInfo\Command\ZeroMission;

use MfZmInfo\Command\AbstractGetRomDataMap;
use MfZmInfo\Exception\GameNotFoundException;
use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\RegionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'zm:map:romdata',
    description: 'Get ROM Data map for Metroid Zero Mission',
    hidden: false
)]
final class GetRomDataMap extends AbstractGetRomDataMap
{
    /**
     * @throws GameNotFoundException
     * @throws InvalidRegionException
     * @throws MissingVariableException
     * @throws ResourceNotFoundException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $region = $input->getArgument('region') ?? RegionInterface::REGION_USA;
        $this->game = new Fusion($region);

        return parent::execute($input, $output);
    }
}
