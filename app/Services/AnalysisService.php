<?php


namespace App\Services;


use App\Http\Resources\AnalysisCollection;
use App\Models\Analysis;

class AnalysisService extends Service
{
    protected string $class = Analysis::class;

    public function getCollectionClass(): string
    {
        return AnalysisCollection::class;
    }

    public function getValidators(): array
    {
        return [];
    }

}