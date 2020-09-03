<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Holiday
 *
 * @property int $id
 * @property int|null $year
 * @property int $month
 * @property int $day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday whereYear($value)
 * @mixin \Eloquent
 */
class Holiday extends Model
{
    protected $fillable = ['year', 'month', 'day'];

    public function getFormattedDate(int $year = null)
    {
        return implode('-', [
            $this->getFormattedMonth(),
            $this->getFormattedDay(),
            $year ?? $this->year
        ]);
    }

    private function getFormattedMonth()
    {
        return str_pad($this->month + 1, 2, '0', STR_PAD_LEFT);
    }

    private function getFormattedDay()
    {
        return str_pad($this->day, 2, '0', STR_PAD_LEFT);
    }
}
