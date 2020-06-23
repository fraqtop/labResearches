<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Gene
 *
 * @property int $id
 * @property string $name
 * @property string $coords
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene whereCoords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gene whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genotype[] $genotypes
 * @property-read int|null $genotypes_count
 */
class Gene extends Model
{
    protected $fillable = ['name', 'coords', 'description'];

    public function genotypes()
    {
        return $this->hasMany(Genotype::class, 'gene_id');
    }
}
