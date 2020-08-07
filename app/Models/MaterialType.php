<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaterialType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MaterialType extends Model
{
    protected $fillable = ['name'];
}
