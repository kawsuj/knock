<?php

namespace Knock;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    
    protected $fillable = [
    	'event_code',
    	'event_data'
    ];
}
