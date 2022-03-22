<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface StructInterface
{
    public function getDescription(): string;

    public function getType(): string;

    public function offset(): string;

    /**
     * @return EnumInterface[]
     */
    public function getEnums(): array;
}