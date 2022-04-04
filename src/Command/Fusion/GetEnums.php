<?php

declare(strict_types=1);

namespace MfZmInfo\Command\Fusion;

use MfZmInfo\Command\AbstractGetEnums;
use MfZmInfo\Model\Game\Fusion;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mf:map:enums',
    description: 'Get ENUMS for Metroid Fusion',
    hidden: false
)]
final class GetEnums extends AbstractGetEnums
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->game = new Fusion();

        return parent::execute($input, $output);
    }
}
