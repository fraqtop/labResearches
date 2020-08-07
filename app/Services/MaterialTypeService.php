<?php


namespace App\Services;


use App\Http\Resources\DictionaryCollection;
use App\Models\MaterialType;

class MaterialTypeService extends Service
{
    protected string $class = MaterialType::class;

    public function getCollectionClass(): string
    {
        return DictionaryCollection::class;
    }

}