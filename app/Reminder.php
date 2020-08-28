<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table = 'reminders';

    protected $fillable = ['medicine_id', 'datum', 'dosering',  'tijd'];
}
