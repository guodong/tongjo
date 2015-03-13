<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response as Responses;
class EmailController extends BaseController {

	public function verify()
	{
		$user = User::find(Input::get('id'));
		if(!$user)
		    return 0;
		if ($user->email_verify_code != Input::get('code')){
		    return 0;
		}
		$user->is_email_verified = 1;
		$user->save();
		return 1;
	}
	
	public function send()
	{
	    $user = User::find(Input::get('id'));
	    Mail::send('emails.auth.register', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message)
	    {
	        $message->to($user->email, '您好')->subject('欢迎加入同舟!');
	    });
	}

}