<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
class AccesstokenController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('email = ? and password = ?', array(Input::get('email'), md5(Input::get('password'))))->first();

		if($user){
		    $token = md5($user->id.time());
		    Cache::put($user->id, $user, 10);
		    $user->accesstoken = $token;
		    return $user->toJson();
		}else{
		    return json_encode(array('error'=>1));
		}
	}
	
}
