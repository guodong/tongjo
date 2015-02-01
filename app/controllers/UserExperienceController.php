<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
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

	public function update ($user_id, $exp_id)
	{
	    $data = Experience::find($exp_id);
	    $data->update(Input::get());
	    return $data;
	}
	
	public function destroy($user_id, $exp_id)
	{
	    $exp = Experience::find($exp_id);
	    $exp->delete();
	    return json_encode(array('result'=>0, 'msg'=>'success'));
	}
}
