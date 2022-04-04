<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface CodeInterface extends RegionInterface
{
    public function getDescription(): string;

    public function getLabel(): string;

    public function getAddress(): string;

    public function getSize(): string;

    public function getMode(): string;

    public function getParameters(): array;

    public function getReturn(): array;

    public function getNotes(): ?string;
}
