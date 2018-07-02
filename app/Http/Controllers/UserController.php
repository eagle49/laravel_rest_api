<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends Controller
{
    public function getsignup(Request $request) {

    	$data = $request->all();

        $isValid = Validator::make($data, [
            'email' => 'unique:users'
        ]);

        if ($isValid->fails()) {
        	return response(array('status'=>STATUS_ERROR));
		}
		
		$token = $this->RandomString(20);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'remember_token' => $token,
        ]);
        return response(array('status'=> STATUS_SUCCESS , 'token' => $token ));

    }

    public function getlogin(Request $request){

		$email = $request['email'];
		$password = $request['password'];

    	if (Auth::attempt(['email' => $email, 'password' => $password]))
		{
			$user = Auth::user();
			$user_role = $user['userrole'];
			$confirmed = $user['confirmed'];
            if ($confirmed)
                // The user active and success to login
                return response(array( 'status' => STATUS_SUCCESS, 
                                       'userrole'=>$user_role, 
                                       'confirmed' => USER_CONFIRMED, 
                                       'user' => json_encode($user) )
                                    );
            else
                // The user is not active
                return response(array('status' => STATUS_ERROR, 
                                      'confirmed' => USER_NOT_CONFIRMED, 
                                      'credential' => AUTH_SUCCESS)
                                    );
		}else{
            //echo "UserName and password does not match.";	
			return response(array( 'status' => STATUS_ERROR, 'credential' => AUTH_FAILURE ));			
        }

    }

    public function getSignOut() {
        Auth::logout();
        return response(array( 'status' => STATUS_SUCCESS ));
    }

    private function RandomString($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		for ($i = 0; $i < $length; $i++) {
			$randstring .= $characters[rand(0, strlen($characters)-1)];
		}
		return $randstring;
    }
    
    public function sendvcode(Request $request) {

		$email = $request['email'];
		$user = User::where('email', '=', $email)->first();
		if(!$user) {
			return response(array( 'status' => STATUS_ERROR ));
		}
		$confirmation_code = $this->RandomString(48);
		$user['confirmation_code'] = $confirmation_code;
		$user->save();

        $data = array( 'confirmation_code' => $confirmation_code, 
                       'email' => $email, 
                       'name' => $user['name'], 
                       'url' => APP_URL.'verify/'.$confirmation_code 
                    );
		Mail::send('email.verify', $data, function($message) use ($data) {
            $message->to($data['email'], 'To Customer')
                ->subject('Verify your email address');
            $message->from('donotreply@taskdone.ca', 'Taskdone');
		});
		
		return response(array( 'status' => STATUS_SUCCESS ));
    }
    
    public function getverify(Request $request) {

		$code = $request['verify_code'];
		$user = User::where('confirmation_code','=', $code)->first();
		if($user) {
			$user['confirmed'] = 1;
			$user->save();
			return response(array('status' => STATUS_SUCCESS ));
		} else {
			return response(array('status'=> STATUS_ERROR ));
		}
	}
}
