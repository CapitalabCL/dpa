<?php

namespace Capitalab\DPA;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regiones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'ordinal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'region_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function comunas()
    {
        return $this->hasManyThrough(
            Comuna::class,
            Provincia::class,
            'region_id',
            'provincia_id'
        );
    }

}
