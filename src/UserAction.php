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
	
	public function isValid(){
		return $this->valid_from;
	 	//$now = Carbon::now();
	 	//$from = Carbon::parse($this->valid_from);
		//$instance = static::createFromFormat('Y-n-j G:i:s',
		//$until = Carbon::parse($this->valid_until);
		//return $from <= Carbon::now() && Carbon::now() <
	} 
	

}
