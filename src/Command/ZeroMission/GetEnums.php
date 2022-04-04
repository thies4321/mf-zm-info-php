<?php

declare(strict_types=1);

namespace MfZmInfo\Command\ZeroMission;

use MfZmInfo\Command\AbstractGetEnums;
use MfZmInfo\Model\Game\ZeroMission;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'zm:map:enums',
    description: 'Get ENUMS for Metroid Zero Mission',
    hidden: false
)]
final class GetEnums extends AbstractGetEnums
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->game = new ZeroMission();

        return parent::execute($input, $output);
    }
}
