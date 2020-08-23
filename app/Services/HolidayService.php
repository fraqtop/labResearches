<?php


namespace App\Services;


use App\Http\Resources\HolidayCollection;
use App\Models\Holiday;

class HolidayService extends Service
{
    protected string $class = Holiday::class;

    public function getCollectionClass(): string
    {
        return HolidayCollection::class;
    }

    public function getValidators(): array
    {
        return [
            'month' => ['required', 'integer', 'between:0,11'],
            'day' => ['required', 'integer', 'between:1,31']
        ];
    }

}