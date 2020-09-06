<?php


namespace App\Services;


use App\Http\Resources\DictionaryCollection;
use App\Models\GenotypeStatus;

class GenotypeStatusService extends Service
{
    public const OK = 1;
    public const ACCEPTABLE = 2;
    public const CORRUPTED = 3;
    protected string $class = GenotypeStatus::class;

    public function getCollectionClass(): string
    {
        return DictionaryCollection::class;
    }

    public function getAll()
    {
        return [
            static::OK,
            static::ACCEPTABLE,
            static::CORRUPTED
        ];
    }
}
