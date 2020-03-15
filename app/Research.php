<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Research
 *
 * @property int $id
 * @property string $title
 * @property int $days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Research whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Research extends Model
{
    protected $fillable = ['title', 'days'];
}
