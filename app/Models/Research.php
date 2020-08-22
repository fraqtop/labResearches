<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Research
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $inner_number
 * @property string $registered_at
 * @property string|null $material_taken_at
 * @property int $patient_id
 * @property int $initiator_id
 * @property int $user_id
 * @property string|null $diagnosis
 * @property int|null $material_id
 * @property int $analysis_id
 * @property int $pay_type_id
 * @property string $issue_planed_at
 * @property string|null $issued_at
 * @property string|null $comment
 * @property Institution $initiator
 * @property Institution $executor
 * @property Patient $patient
 * @property PayType $payType
 * @property MaterialType $materialType
 * @property Analysis $analysis
 * @property User $user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereAnalysisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereDiagnosis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereInitiatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereInnerNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereIssuePlanedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereIssuedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereMaterialTakenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research wherePayTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Research whereUserId($value)
 */
class Research extends Model
{
    protected $table = 'researches';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function executor()
    {
        return $this->belongsTo(Institution::class, 'executor_id', 'id');
    }

    public function payType()
    {
        return $this->belongsTo(PayType::class, 'pay_type_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(MaterialType::class, 'material_id', 'id');
    }

    public function analysis()
    {
        return $this->belongsTo(Analysis::class, 'analysis_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function initiator()
    {
        return $this->belongsTo(Institution::class, 'initiator_id', 'id');
    }
}
