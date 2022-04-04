<?php

declare(strict_types=1);

namespace MfZmInfo\Command;

use MfZmInfo\Exception\GameNotFoundException;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\EnumRepository\EnumRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractGetEnums extends Command
{
    protected GameInterface $game;

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $game = $this->game ?? throw GameNotFoundException::forCommand();

        $repo = new EnumRepository($game);
        $enums = $repo->findAll();

        $table = new Table($output);
        $table->setHeaders([
            'Type',
            'Value',
            'Description',
        ]);

        foreach ($enums as $enum) {
            $table->addRow([
                $enum->getType(),
                $enum->getValue(),
                $enum->getDescription(),
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}
