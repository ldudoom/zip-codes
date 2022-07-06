<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\DataFilter;
use App\Services\DataLoad;
use App\Services\ParsingData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ZipCodesController extends Controller
{
    private DataLoad $_loadedData;
    private DataFilter $_filteredData;
    private ParsingData $_parsedData;

    public function __construct(DataLoad $loadedData, DataFilter $filteredData, ParsingData $parsedData)
    {
        $this->_loadedData = $loadedData;
        $this->_filteredData = $filteredData;
        $this->_parsedData = $parsedData;
    }

    public function show(string $zipCode): JsonResponse
    {
        if( ! $zipCode){
            abort(Response::HTTP_NOT_FOUND);
        }
        $loadData = $this->_loadedData->loadData(config('zipCodes.zip_codes_file'));
        $filteredData = $this->_filteredData->filterData($loadData, $zipCode);
        return response()->json($this->_parsedData->fieldParsed($filteredData));
    }
}
