<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface RamInterface extends RegionInterface
{
    public function getDescription(): string;

    public function getLabel(): string;

    public function getAddress(): string;

    public function getSize(): ?string;

    public function getType(): ?string;

    public function getCount(): ?string;

    public function getEnum(): ?string;
}
