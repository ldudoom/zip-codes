<?php

namespace App\Services;

class DataFilter implements \App\Interfaces\DataFilterInterface
{

    public function filterData(array $data, string $zipCode): array
    {
        return array_filter($data, function($value) use($zipCode){
            return substr($value,0,5) === $zipCode;
        });
    }
}