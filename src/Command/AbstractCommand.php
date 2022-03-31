<?php

declare(strict_types=1);

namespace MfZmInfo\Command;

use MfZmInfo\Service\LengthConverterService;
use Symfony\Component\Console\Command\Command;

abstract class AbstractCommand extends Command
{
    protected LengthConverterService $lengthConverterService;

    public function __construct(LengthConverterService $lengthConverterService = null)
    {
        $this->lengthConverterService = $lengthConverterService ?? new LengthConverterService();

        parent::__construct();
    }
}