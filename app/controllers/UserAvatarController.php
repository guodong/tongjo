<?php

use Illuminate\Support\Facades\Input;
class UserAvatarController extends BaseController {

	public function index()
	{
	    return Major::all()->toJson();
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    $project->categorys;
	    return $project->toJson();
	}
	
	public function store($user_id)
	{
	    $fn = time().'.jpg';
	    $dst = PATH_BASE.'public/files/'.$fn;
	    $img = str_replace('data:image/png;base64,', '', Input::get('image'));
	    $data = base64_decode($img);
	    file_put_contents($dst, $data);
	    $user = User::find($user_id);
	    $user->avatar = $fn;
	    $user->save();
	    return $user;
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
