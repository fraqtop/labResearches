<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GenotypeStatus
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenotypeStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenotypeStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenotypeStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenotypeStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GenotypeStatus whereName($value)
 * @mixin \Eloquent
 */
class GenotypeStatus extends Model
{
    public $timestamps = false;
}
