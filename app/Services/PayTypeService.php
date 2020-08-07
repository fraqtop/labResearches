<?php


namespace App\Services;


use App\Http\Resources\DictionaryCollection;
use App\Models\PayType;

class PayTypeService extends Service
{
    protected string $class = PayType::class;

    public function getCollectionClass(): string
    {
        return DictionaryCollection::class;
    }

}