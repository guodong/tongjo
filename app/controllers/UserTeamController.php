<?php

use Illuminate\Support\Facades\Input;
class UserTeamController extends BaseController {

	public function index($user_id)
	{
	    $user = User::find($user_id);
		
		return $user->joinedTeams->toJson();
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    return $project->toJson();
	}
	
	public function store()
	{
	    $project = Project::create(Input::get());
	    return $project->toJson();
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    foreach (Input::get() as $k=>$v){
	        $project->{$k} = $v;
	    }
	    $project->save();
	}

}
