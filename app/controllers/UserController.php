<?php

use Illuminate\Support\Facades\Input;
class UserController extends BaseController {

    // GET /user
	public function index()
	{
		$users = User::all();
		return $users->toJson();
	}
	
	// GET /user/$id
	public function show($id)
	{
	    $user = User::find($id);
	    if($user){
	        $user->school;
	        $user->major;
	        $user->tags;
	        return $user;
	    }else{
	        return json_encode(array('error'=>1, 'msg'=>'no user'));
	    }
	}

	// POST /user
	public function store()
	{
	    $_POST['password'] = md5($_POST['password']);
	    $_POST['email_verify_code'] = uniqid();
	    $user = User::create($_POST);
	    Mail::send('emails.auth.register', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message)
	    {
	        $message->to($user->email, '您好')->subject('欢迎加入同舟!');
	    });
	    return $user->toJson();
	}
	
	// PUT /user/$id
	public function update($id)
	{
	    $this->auth($id);
	    $user = User::find($id);
	    foreach (Input::get() as $k=>$v){
	        if (is_string($v) || is_numeric($v)){
	            $user->{$k} = $v;
	            //echo $user->realname;
	        }
	    }
	    //echo $user->realname;
	    $user->save();
	    return $user->toJson();
	}
}
