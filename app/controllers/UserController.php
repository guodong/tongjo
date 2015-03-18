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
	    $_POST['realname'] = '同志'.rand(1, 9999);
	    $_POST['avatar'] = 'sysavatar/'.rand(1, 40).'.jpg';
	    $user = User::create($_POST);
	    
	    Mail::send('emails.auth.register', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message) use ($user)
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
	
	public function resetpassword()
	{
	    //找回密码
	    if (Input::get('code')){
	        $user = User::find(Input::get('uid'));
	        $user->password = md5(Input::get('newpsw'));
	        $user->save();
	        return 0;
	    }
	    //修改密码
	    $this->auth(Input::get('uid'));
	    $user = User::find(Input::get('uid'));
	    if ($user->password != md5(Input::get('oldpsw'))){
	        return 1;
	    }
	    $user->password = md5(Input::get('newpsw'));
	    $user->save();
	    return 0;
	}
	
	public function findpassword()
	{
	    $user = User::where('email', '=', Input::get('email'))->first();
	    if ($user){
	        if (!$user->email_verify_code){
	            $user->email_verify_code = uniqid();
	            $user->save();
	        }
	        Mail::send('emails.auth.findpsw', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message) use ($user)
	        {
	            $message->to($user->email, '您好')->subject('同舟密码重置');
	        });
	        return 1;
	    }
	}
}
