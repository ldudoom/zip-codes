<?php

namespace App\Interfaces;

interface DataLoadInterface
{
    public function loadData(string $fileName): array;
}