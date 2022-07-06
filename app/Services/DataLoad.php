<?php

namespace App\Services;

class DataLoad implements \App\Interfaces\DataLoadInterface
{

    public function loadData(string $fileName): array
    {
        $zipCodesFile = file(storage_path('app/'.$fileName), FILE_SKIP_EMPTY_LINES);
        unset($zipCodesFile[0]);
        return $zipCodesFile;
    }
}