<?php

namespace App\Interfaces;

interface DataFilterInterface
{
    public function filterData(array $data, string $zipCode): array;
}