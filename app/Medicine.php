<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $fillable = ['naam', 'dosering', 'wanneer', 'datum_van', 'datum_tot', 'tijd'];
}
