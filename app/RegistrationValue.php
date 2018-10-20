<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationValue extends Model
{
    protected $fillable = ['field_id', 'event_registration_id', 'value'];
}
