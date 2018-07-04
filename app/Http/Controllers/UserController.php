<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
use App\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends Controller
{
    public function getsignup(Request $request) {

    	$data = $request->all();

        //Check if email is exist
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

    /**
     * Reset Password
     */
    public function resetPassword(Request $request) {
        $email = $request['email'];
        $password = Hash::make($request['password']);

        $user = User::where('email', '=', $email)->first();
        if ( $user ) {
            $user->password = $password;
            $user->save();
            return response(array( 'status' => STATUS_SUCCESS ));
        } else { 
            return response(array('status' => STATUS_ERROR ));
        }
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

    /**
     * create random string
     * @para $length
     */
    private function RandomString($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		for ($i = 0; $i < $length; $i++) {
			$randstring .= $characters[rand(0, strlen($characters)-1)];
		}
		return $randstring;
    }
    
    /**
     * send verification code to user`s email when signup
     */
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
                       'url' => APP_URL.'pages/auth/reset-password/'.$confirmation_code
                    );
		Mail::send('email.verify', $data, function($message) use ($data) {
            $message->to($data['email'], 'To Customer')
                ->subject('Verify your email address');
            $message->from('donotreply@taskdone.ca', 'Taskdone');
		});
		
		return response(array( 'status' => STATUS_SUCCESS ));
    }
    
    /**
     * verify user with verification link that is sent to user`s email
     */
    public function getverify(Request $request) {

		$code = $request['verify_code'];
		$user = User::where('confirmation_code','=', $code)->first();
		if( $user ) {
			$user['confirmed'] = 1;
			$user->save();
			return response(array('status' => STATUS_SUCCESS ));
		} else {
			return response(array('status'=> STATUS_ERROR ));
		}
    }
    
    /**
     * send reset verification link to email (when forgot password)
     */
    public function sendResetLink(Request $request) {
        $email = $request['email'];
        
        // get user with email
        $user = User::where('email','=', $email)->first();

        // check if the user with this email is exist
        if ( $user ) {
            
            $confirmation_code = $this->RandomString(50);

            // Create PasswordReset field in database
            PasswordReset::create([
                'email' => $email,
                'token' => $confirmation_code
            ]);

            $data = array( 'confirmation_code' => $confirmation_code, 
                       'email' => $email, 
                       'name' => $user['name'], 
                       'url' => APP_URL.'pages/auth/reset-password/'.$confirmation_code 
                    );
            Mail::send('email.reset', $data, function($message) use ($data) {
                $message->to($data['email'], 'To Customer')
                    ->from('donotreply@taskdone.ca', 'Taskdone')
                    ->subject('Forgotten Password Reset Request')
                    ->getSwiftMessage()
                    ->getHeaders()
                    ->addTextHeader('x-mailgun-native-send', 'true');
            });
            return response(array( 'status' => 'success' ));
            // send reset password link to this email
        } else {
            // user is not exist
            return response(array( 'status' => 'failure' ));
        }
    }

    /**
     * Verify reset verification code
     */
    public function getResetVerify(Request $request) {
        // password_reset field - email/token/created_at/updated_at
        $code = $request['verify_code'];
        $resetPw = PasswordReset::where('token','=', $code)->first();
        if ( $resetPw ) {
            $email = $resetPw['email'];
            $user = User::where('email', '=', $email)->first();

            if ( $user ) {
                return response(array('status' => STATUS_SUCCESS, 'email' => $email ));
            } else {
                return response(array('status' => STATUS_ERROR ));
            }
        } else {
            return response(array('status' => STATUS_ERROR ));
        }
    }
}
