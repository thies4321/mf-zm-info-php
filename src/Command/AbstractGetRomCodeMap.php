<?php

declare(strict_types=1);

namespace MfZmInfo\Command;

use MfZmInfo\Exception\GameNotFoundException;
use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Repository\CodeRepository\CodeRepository;
use MfZmInfo\Service\LengthConverterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function rtrim;
use function sprintf;

abstract class AbstractGetRomCodeMap extends Command
{
    protected GameInterface $game;

    public function configure(): void
    {
        $this->addArgument('region', InputArgument::OPTIONAL, 'Which game region should be used');
    }

    /**
     * @throws GameNotFoundException
     * @throws MissingVariableException
     * @throws ResourceNotFoundException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $game = $this->game ?? throw GameNotFoundException::forCommand();

        $repo = new CodeRepository($game);
        $lengthConverterService = new LengthConverterService($game);

        $codes = $repo->findAll();

        $table = new Table($output);
        $table->setHeaders([
            'Address',
            'Length',
            'Description',
            'Arguments',
            'Returns',
        ]);

        foreach ($codes as $code) {
            $arguments = '';

            foreach ($code->getParameters() as $parameter) {
                $arguments .= sprintf('%s %s%s', $parameter['type'], $parameter['description'], PHP_EOL);
            }

            if ($arguments === '') {
                $arguments = 'void';
            }

            $return = 'void';

            if (! empty($code->getReturn())) {
                $return = sprintf('%s %s%s', $code->getReturn()['type'], $code->getReturn()['description'], PHP_EOL);
            }

            $table->addRow([
                $code->getAddress(),
                $lengthConverterService->getHexadecimalLength(
                    $code->getSize(),
                    null,
                    null
                ),
                $code->getDescription(),
                rtrim($arguments, '\n'),
                $return,
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}
