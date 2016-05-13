<?php

namespace Knock;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $table = 'tags';
    protected $fillable = ['name', 'description'];

    public function roles(){
		return $this->hasMany(\Knock\Role::class);
	}   

}
