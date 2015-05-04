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
	    if(!$user->email_verify_code){
	        $user->email_verify_code = uniqid();
	        $user->save();
	    }
	    Mail::send('emails.auth.register', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message) use ($user)
	    {
	        $message->to($user->email, '您好')->subject('欢迎加入同舟!');
	    });
	}
	
	public function broadcast()
	{
	    $project = Project::find(Input::get('project_id'));
	    foreach($project->users as $v){
	        Mail::send('emails.broadcast', array('title' => Input::get('title'), 'content'=>Input::get('content')), function($message) use ($v)
	        {
	            $message->to($v->email, $v->realname)->subject(Input::get('title'));
	        });
	    }
	    foreach ($project->teams as $team){
	        foreach ($team->members as $v){
	            Mail::send('emails.broadcast', array('title' => Input::get('title'), 'content'=>Input::get('content')), function($message) use ($v)
	            {
	                $message->to($v->email, $v->realname)->subject(Input::get('title'));
	            });
	        }
	    }
	}

}