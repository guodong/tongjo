<?php

use Illuminate\Support\Facades\Input;
class ProjectUserController extends BaseController {

	public function index($project_id)
	{
		$project = Project::find($project_id);
		return $project->users;
	}
	
	public function store($project_id)
	{
	    $project = Project::find($project_id);
	    $project->users()->attach(Input::get('user_id'));
	    return $project;
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
