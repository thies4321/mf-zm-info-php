<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

interface CodeInterface
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

//[0] => desc
//[1] => label
//[2] => addr
//[3] => size
//[4] => mode
//[5] => params
//[6] => return
//    [7] => notes
