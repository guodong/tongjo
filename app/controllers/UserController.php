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
	        return $user->toJson();
	    }else{
	        return json_encode(array('error'=>1, 'msg'=>'no user'));
	    }
	}

	// POST /user
	public function store()
	{
	    $_POST['password'] = md5($_POST['password']);
	    $user = User::create($_POST);
	    return $user->toJson();
	}
	
	// PUT /user/$id
	public function update($id)
	{
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
