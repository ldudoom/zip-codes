<?php

namespace App\Services;

class ParsingData implements \App\Interfaces\ParsingDataInterface
{

    public function fieldParsed(array $zipCodeDetail): array
    {
        $zipCodeWithoutSpecialChars = array_map([$this, '_removeSpecialChars'], $zipCodeDetail);
        $zipCodeExploded = $this->_explodeZipCodeInfo($zipCodeWithoutSpecialChars);
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
            $aZipCodes['locality'] = strtoupper($zipCodes[5]);
            $aZipCodes['federal_entity'] = array(
                'key' => (int)$zipCodes[7],
                'name' => strtoupper($zipCodes[4]),
                'code' => $zipCodes[9] != '' ? (int)$zipCodes[9] : null
            );
            $aZipCodes['settlements'][] = [
                'key' => (int)$zipCodes[12],
                'name' => strtoupper($zipCodes[1]),
                'zone_type' => strtoupper($zipCodes[13]),
                'settlement_type' => [
                    'name' => $zipCodes[2],
                ]
            ];
            $aZipCodes['municipality'] = [
                'key' => (int)$zipCodes[11],
                'name' => strtoupper($zipCodes[3])
            ];
        }
        return $aZipCodes;
    }

    private function _removeSpecialChars(string $string): string
    {
        $string = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $string
        );

        $string = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $string );

        $string = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $string );

        $string = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $string );

        $string = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $string );

        $string = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $string
        );

        return $string;
    }

}