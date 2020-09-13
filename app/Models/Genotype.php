<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Genotype
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $gene_id
 * @property Gene $gene
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereGeneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $genotype_status_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genotype whereGenotypeStatusId($value)
 * @property-read \App\Models\GenotypeStatus $status
 */
class Genotype extends Model
{
    protected $fillable = ['name', 'description', 'genotype_status_id', 'gene_id'];

    public function status()
    {
        return $this->belongsTo(GenotypeStatus::class, 'genotype_status_id', 'id');
    }

    public function gene()
    {
        return $this->hasOne(Gene::class, 'id', 'gene_id');
    }
}
