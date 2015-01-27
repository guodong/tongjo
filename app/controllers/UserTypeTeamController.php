<?php

use Illuminate\Support\Facades\Input;
class UserTypeTeamController extends BaseController {

	public function index($user_id, $type)
	{
	    $user = User::find($user_id);
	    if($type == 'joined'){
	        foreach ($user->joinedTeams as $v){
	            $v->project;
	        }
	        return $user->joinedTeams;
	    }else{

	        foreach ($user->createdTeams as $v){
	            $v->project;
	        }
	        return $user->createdTeams;
	    }
		
	}
	
	public function show($id)
	{
	    $team = Team::find($id);
	    return $team;
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
