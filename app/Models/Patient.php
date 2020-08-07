<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $name
 * @property string|null $mail
 * @property string|null $phone
 * @property string $birth_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Patient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Patient extends Model
{
    protected $fillable = ['name', 'mail', 'phone', 'birth_date'];
}
