<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Analysis
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property float $price
 * @property int $duration
 * @property int $type_id
 * @property AnalysisType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereTypeId($value)
 * @mixin \Eloquent
 */
class Analysis extends Model
{
    protected $fillable = ['code', 'description', 'price', 'duration', 'type_id', 'executor'];

    public function type()
    {
        return $this->belongsTo(AnalysisType::class, 'type_id', 'id');
    }
}
