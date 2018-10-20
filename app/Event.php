<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'time'
    ];

    //
    public function fields()
    {
        return $this->belongsToMany('App\Field', 'event_fields');
    }
}
