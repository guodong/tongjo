<?php

use Illuminate\Support\Facades\Input;
class ProjectTeamController extends BaseController {

	public function index($project_id)
	{
		$project = Project::find($project_id);
		return $project->teams;
	}
	
	public function store($project_id)
	{
	    $project = Project::find($project_id);
	    $project->users()->attach(Input::get('user_id'));
	    return $project;
	}


}
