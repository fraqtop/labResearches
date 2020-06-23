<?php


namespace App\Services;


use App\Models\GenotypeStatus;

class GenotypeStatusService extends Service
{
    public const OK = 1;
    public const ACCEPTABLE = 2;
    public const CORRUPTED = 3;

    public function getAll()
    {
        return [
            static::OK,
            static::ACCEPTABLE,
            static::CORRUPTED
        ];
    }

    public static function load($filters)
    {
        return GenotypeStatus::query();
    }
}
