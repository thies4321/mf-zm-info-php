<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface DataInterface
{
    public function getDescription(): string;

    public function getLabel(): string;

    public function getType(): string;

    public function getAddress(): array;

    public function getCount(): ?int;

    public function getEnums();
}