<?php

namespace Knock\Http\Controllers\Auth;

use Auth;
use Knock\User;
use Knock\UserAction;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    /* protected $redirectTo = '/knock/home'; */
    protected $redirectTo = 'home'; 
    protected $redirectAfterLogout = '/';
    protected $loginView = 'knock::auth.users.login';
    protected $registerView = 'knock::auth.users.register';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth', ['except' => array('getLogin', 'postLogin')]);
    	
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'active' => 'required',
        	'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'active' => $data['active'],
            'password' => bcrypt($data['password']),
        ]);
        $this->applyPermissions($user, $data);
        return $user;
    }
    
    private function applyPermissions($user, $data){
    	$user->actions()->delete();
    	$keys = array_keys($data);
		foreach($keys as $key){
			if (starts_with($key, 'action_')){
    			$userAction = new UserAction;
	    		$userAction->user_id = $user->id;
	    		$userAction->action_id = substr(strrchr($key, "_"), 1); //the number following the prefix
	    		$userAction->save();
			}
		}
	}

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
		if(Auth::check()){
			$user = $this->create($request->all());
			logEvent('user-registered', 'User Email='.$request->email);
			return redirect(asset('/users/'.$user->id))->with('flash_message', 'User '.$request->get('email').' Created');	
		}else{
			Auth::login($this->create($request->all()));
			//return redirect($this->redirectPath());
			return redirect(asset('/'))->with('flash_message', 'User '.$request->get('email').' Created');	
		}
    }     
	
    
    public function postLogin(Request $request){
    	logEvent('user-logged-in', '[User='.$request->email.']'. ', User-Agent=['. $request->header('User-Agent').']'. ', Client=['. getLocation().']');
    	return $this->login($request);
    }
       
}
