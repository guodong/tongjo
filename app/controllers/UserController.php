<?php

use Illuminate\Support\Facades\Input;
class UserController extends BaseController {

	public function index()
	{
		$users = User::all();
		return $users->toJson();
	}
	
	public function show($id)
	{
	    $user = User::find($id);
	    if($user){
	        return $user->toJson();
	    }else{
	        return json_encode(array('error'=>1));
	    }
	}

	public function store()
	{
	    $user = User::create($_POST);
	    return $user->toJson();
	}
	
	public function update($id)
	{
	    $user = User::find($id);
	    foreach (Input::get() as $k=>$v){
	        $user->{$k} = $v;
	    }
	    $user->save();
	    return $user->toJson();
	}
}
