<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface GameInterface extends RegionInterface
{
    public function getName(): string;

    public function getShortName(): string;

    public function getSha1(): string;

    public function getMd5(): string;

    public function getCrc(): string;
}
