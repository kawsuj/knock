<?php

namespace Knock;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
    protected $fillable = ['tag_id', 'name', 'description'];

    public function tag(){
		return $this->belongsTo(\Knock\Tag::class);
	}

    public function actions(){
		return $this->hasMany(\Knock\Action::class);
	}  
	
}
