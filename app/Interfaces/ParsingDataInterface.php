<?php

namespace App\Interfaces;

interface ParsingDataInterface
{
    public function fieldParsed(array $zipCodeDetail): array;
}