<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response as Responses;
class LoginController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('email = ? and password = ?', array(Input::get('email'), Input::get('password')))->first();		
		if($user){
		    $token = md5($user->id.time());
		    Cache::put($user->id, $user, 10);
		    $user->accesstoken = $token;
		    $response = array('result' => array(
		    		'code' => 0, 
		    		'message' => 'no problem'), 
		    		'userId'=> $user->id, 
		    		'email'=> $user->email, 
		    		'realName'=> $user->realname, 
		    		'gender'=> $user->gender);
			return Responses::json($response);
		}else{
		    return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}

}