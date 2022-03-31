<?php

declare(strict_types=1);

namespace MfZmInfo\Command\Fusion;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\Game\Fusion;
use MfZmInfo\Model\RegionInterface;
use MfZmInfo\Repository\RamRepository\RamRepository;
use MfZmInfo\Service\LengthConverterService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mf:map:ram',
    description: 'Get RAM map for Metroid Fusion',
    hidden: false
)]
final class GetRamMap extends Command
{
    public function configure()
    {
        $this->addArgument('region', InputArgument::OPTIONAL, 'Which game region should be used');
    }

    /**
     * @throws InvalidRegionException
     * @throws ResourceNotFoundException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $region = $input->getArgument('region') ?? RegionInterface::REGION_USA;
        $game = new Fusion($region);
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
                $lengthConverterService->getHexidecimalLength(
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
