<?php


namespace App\Services;


use App\Http\Resources\HolidayCollection;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HolidayService extends Service
{
    public const LIST_MODE = [
        'grouped' => 1,
        'flat' => 2
    ];

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

    public function load(array $filters = null)
    {
        $mode = $filters['mode'] ?? static::LIST_MODE['grouped'];
        switch ($mode) {
            case static::LIST_MODE['grouped']:
                return $this->getGrouped();
            case static::LIST_MODE['flat']:
                return $this->getFlat();
        }
        return [];
    }

    private function getGrouped()
    {
        $data = DB::table('holidays')
            ->select('day', 'month')
            ->where(['year' => Carbon::now()->year])
            ->orWhereNull('year')
            ->get()
            ->toArray();

        return array_reduce($data, function($result, $item) {
            $result[$item->month][] = $item->day;
            return $result;
        }, []);
    }

    private function getFlat()
    {
        $year = Carbon::now()->year;
        $holidays = Holiday::query()
            ->whereIn('year', [$year, $year + 1])
            ->orWhereNull('year')
            ->get(['year', 'month', 'day']);
        return $holidays->reduce(function ($result, Holiday $holiday) use ($year) {
            if (!$holiday->year) {
                $result[] = $holiday->getFormattedDate($year);
                $result[] = $holiday->getFormattedDate($year + 1);
            } else {
                $result[] = $holiday->getFormattedDate();
            }
            return $result;
        }, []);
    }

}