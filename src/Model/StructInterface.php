<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface StructInterface
{
    public function getType(): string;

    public function getSize(): string;

    public function getVariables(): array;
}