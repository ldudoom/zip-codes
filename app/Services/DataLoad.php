<?php

namespace App\Services;

class DataLoad implements \App\Interfaces\DataLoadInterface
{

    public function loadData(string $fileName): array
    {
        $zipCodesFile = file(storage_path('app/'.$fileName), FILE_SKIP_EMPTY_LINES);
        //$chunks = array_chunk($zipCodesFile,5000); // divido en bloques de 5000
        //unset($chunks[0][0]); // Elimino la cabecera
        //return $chunks;
        unset($zipCodesFile[0]);
        return $zipCodesFile;
    }
}