<?php
namespace Knock;

// use App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * 
 * @author Kawsu Jawara
 *
 *
 */
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
	 	$now = Carbon::now();
	 	$from = Carbon::createFromFormat('Y-n-j G:i:s', $this->valid_from);
		if ($this->valid_until === null){
			return ($now->diffInSeconds($from, false) <= 0);
		}else{
			$until = Carbon::createFromFormat('Y-n-j G:i:s', $this->valid_until);
			return ($now->diffInSeconds($from, false) <= 0) && ($now->diffInSeconds($until, false) >= 0);
		}
	} 
	
	protected static function boot()
	{
		parent::boot();
	
		static::creating(function($userAction){
			$userAction->valid_from = $userAction->created_at;
		});
	}

}
