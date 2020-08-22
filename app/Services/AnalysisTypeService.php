<?php


namespace App\Services;


use App\Http\Resources\DictionaryCollection;
use App\Models\AnalysisType;

class AnalysisTypeService extends Service
{
    protected string $class = AnalysisType::class;

    public function getCollectionClass(): string
    {
        return DictionaryCollection::class;
    }
}