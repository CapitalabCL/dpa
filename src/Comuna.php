<?php

namespace Capitalab\DPA;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
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
    protected $table = 'comunas';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'provincia_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function region()
    {
        return $this->hasOneThrough(
            Region::class,
            Provincia::class,
            'id',
            'id',
            'provincia_id',
            'region_id'
        );
    }

}
