<?php

namespace App\Services;

class ParsingData implements \App\Interfaces\ParsingDataInterface
{

    public function fieldParsed(array $zipCodeDetail): array
    {
        $zipCodeExploded = $this->_explodeZipCodeInfo($zipCodeDetail);
        return $this->_parsingDataStructure($zipCodeExploded);
    }

    private function _explodeZipCodeInfo(array $zipCodes): array
    {
        return array_map(function($zipCode){
            return explode('|', $zipCode);
        }, $zipCodes);
    }

    private function _parsingDataStructure(array $zipCodesExploded): array
    {
        $aZipCodes = [];
        foreach($zipCodesExploded as $zipCodes){
            $aZipCodes['zip_code'] = $zipCodes[0];
            $aZipCodes['locality'] = $zipCodes[5];
            $aZipCodes['federal_entity'] = array(
                'key' => (int)$zipCodes[7],
                'name' => $zipCodes[4],
                'code' => $zipCodes[9] != '' ? (int)$zipCodes[9] : null
            );
            $aZipCodes['settlements'][] = [
                'key' => (int)$zipCodes[12],
                'name' => $zipCodes[1],
                'zone_type' => $zipCodes[13],
                'settlement_type' => [
                    'name' => $zipCodes[2],
                ]
            ];
            $aZipCodes['municipality'] = [
                'key' => (int)$zipCodes[11],
                'name' => $zipCodes[3]
            ];
        }
        return $aZipCodes;
    }

}