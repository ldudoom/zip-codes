<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Interfaces\DataFilterInterface;
use App\Interfaces\DataLoadInterface;
use App\Interfaces\ParsingDataInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ZipCodesController extends Controller
{
    private DataLoadInterface $_loadedData;
    private DataFilterInterface $_filteredData;
    private ParsingDataInterface $_parsedData;

    public function __construct(DataLoadInterface $loadedData, DataFilterInterface $filteredData, ParsingDataInterface $parsedData)
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
