<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $table = 'fuels';
    protected $fillable = ['fuel', 'code', 'volume',];


    public function columns()
    {
        return $this->belongsToMany(Column::class, 'column_has_fuel');
    }
}
