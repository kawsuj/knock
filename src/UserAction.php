<?php
namespace Knock;

// use App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
	protected $table = 'users_actions';

    protected $fillable = ['user_id', 'action_id', 'priority'];

	public function user(){
		return $this->belongsTo(\Knock\User::class, 'user_id');
	}

	public function action(){
		return $this->belongsTo(\Knock\Action::class, 'action_id');
	}
	

}
