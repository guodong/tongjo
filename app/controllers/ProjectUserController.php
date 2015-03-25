<?php

use Illuminate\Support\Facades\Input;
class ProjectUserController extends BaseController {

	public function index($project_id)
	{
		$project = Project::find($project_id);
		return $project->users;
	}


}
