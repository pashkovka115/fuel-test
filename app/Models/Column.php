<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';
    protected $fillable = ['column'];


    public function fuels()
    {
        return $this->belongsToMany(Fuel::class, 'column_has_fuel');
    }
}
