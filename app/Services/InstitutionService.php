<?php


namespace App\Services;


use App\Http\Resources\DictionaryCollection;
use App\Models\Institution;

class InstitutionService extends Service
{
    protected string $class = Institution::class;

    public function getCollectionClass(): string
    {
        return DictionaryCollection::class;
    }

}