<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnalysisType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AnalysisType extends Model
{
    protected $fillable = ['name'];
}
