<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
class LoginController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('email = ? and password = ?', array(Input::get('email'), md5(Input::get('password'))))->first();		
		if($user){
		    $token = md5($user->id.time());
		    Cache::put($user->id, $user, 10);
		    $user->accesstoken = $token;
		    $response = array('result' => array('code' =>0, 'message' => 'no problem'), 'user' => array('userId'=>$user->id, 'email'=>$user->email, 'realName'=>$user->realname, 'gender'=>$user->gender));
		    return json_encode($response);
		}else{
		    return json_encode(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}

}