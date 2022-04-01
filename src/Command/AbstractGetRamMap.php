<?php

declare(strict_types=1);

namespace MfZmInfo\Command;

use MfZmInfo\Exception\GameNotFoundException;
use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Model\RegionInterface;
use MfZmInfo\Repository\RamRepository\RamRepository;
use MfZmInfo\Service\LengthConverterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractGetRamMap extends Command
{
    protected GameInterface $game;

    public function configure(): void
    {
        $this->addArgument('region', InputArgument::OPTIONAL, 'Which game region should be used');
    }

    /**
     * @throws GameNotFoundException
     * @throws InvalidRegionException
     * @throws ResourceNotFoundException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $game = $this->game ?? throw GameNotFoundException::forCommand();

        $repo = new RamRepository($game);
        $lengthConverterService = new LengthConverterService($game);

        $table = new Table($output);
        $table->setHeaders([
            'Address',
            'Length',
            'Description',
        ]);

        foreach ($repo->findAll() as $ram) {
            $table->addRow([
                $ram->getAddress(),
                $lengthConverterService->getHexadecimalLength(
                    $ram->getSize(),
                    $ram->getType(),
                    $ram->getCount()
                ),
                $ram->getDescription(),
            ]);
        }

        $table->render();
        return Command::SUCCESS;
    }
}
