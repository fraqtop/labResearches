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
 * @property string|null $executor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereExecutor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Analysis whereUpdatedAt($value)
 */
class Analysis extends Model
{
    protected $fillable = ['code', 'description', 'price', 'duration', 'type_id', 'executor'];

    public function type()
    {
        return $this->belongsTo(AnalysisType::class, 'type_id', 'id');
    }

    public function genes()
    {
        return $this->hasMany(Gene::class, 'analysis_id', 'id');
    }
}
