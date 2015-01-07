<?php

use Illuminate\Support\Facades\Input;
class TeamUserStatusController extends BaseController {

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
	
	public function update($team_id, $user_id, $status)
	{
	    $team = Team::find($team_id);
	    $team->members()->sync(array($user_id=>array('status'=>$status)));
	    return $team->toJson();
	}

}
