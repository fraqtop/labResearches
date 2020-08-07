<?php


namespace App\Services;


use App\Http\Resources\PatientCollection;
use App\Models\Patient;

class PatientService extends Service
{
    protected string $class = Patient::class;

    public function getCollectionClass(): string
    {
        return PatientCollection::class;
    }
}