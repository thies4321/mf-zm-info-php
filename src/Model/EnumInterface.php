<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface EnumInterface
{
    public function getType(): string;

    public function getDescription(): string;

    public function getValue(): string;
}