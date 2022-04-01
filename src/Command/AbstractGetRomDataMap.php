<?php

declare(strict_types=1);

namespace MfZmInfo\Command;

use MfZmInfo\Exception\GameNotFoundException;
use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\DataRepository\DataRepository;
use MfZmInfo\Service\LengthConverterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractGetRomDataMap extends Command
{
    protected GameInterface $game;

    public function configure(): void
    {
        $this->addArgument('region', InputArgument::OPTIONAL, 'Which game region should be used');
    }

    /**
     * @throws GameNotFoundException
     * @throws InvalidRegionException
     * @throws MissingVariableException
     * @throws ResourceNotFoundException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $game = $this->game ?? throw GameNotFoundException::forCommand();

        $repo = new DataRepository($game);
        $lengthConverterService = new LengthConverterService($game);

        $datas = $repo->findAll();

        $table = new Table($output);
        $table->setHeaders(['Address', 'Length', 'Description']);

        foreach ($datas as $data) {
            $table->addRow([
                $data->getAddress(),
                $lengthConverterService->getHexadecimalLength(
                    $data->getSize(),
                    $data->getType(),
                    $data->getCount()
                ),
                $data->getDescription()
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}