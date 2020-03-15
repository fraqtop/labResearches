<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Holiday
 *
 * @property int $id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Holiday whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Holiday extends Model
{
    protected $fillable = ['date'];
}
