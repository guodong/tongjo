<?php

use Illuminate\Support\Facades\Input;
class UserExperienceController extends BaseController {

	public function index($user_id)
	{
	    return Experience::where('user_id', '=', $user_id)->orderBy('created_at')->get();
	}
	
	public function show($id)
	{
	    return Experience::find($id);
	}
	
	public function store($user_id)
	{
	    $user = User::find($user_id);
	    $exp = new Experience(Input::get());
	    $user->experiences()->save($exp);
	    return $exp;
	}

	public function update ($id)
	{
	    $data = Experience::find($id);
	    $data->update(Input::get());
	    return $data;
	}
}
