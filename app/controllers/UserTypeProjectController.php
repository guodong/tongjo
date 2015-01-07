<?php

use Illuminate\Support\Facades\Input;
class UserTypeProjectController extends BaseController {

	public function index($user_id, $type)
	{
	    $user = User::find($user_id);
	    if ($type == 'created'){
	        $projects = $user->createdProjects;
	        return $projects->toJson();
	    }else if($type == 'joined'){
	        $teams = $user->joinedTeams;
	        $projects = array();
	        foreach ($teams as $v){
	            $projects[] = $v->project;
	        }
		  return json_encode($projects);
	    }
		
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
