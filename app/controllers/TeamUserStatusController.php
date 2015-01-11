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
	    foreach ($team->members as $v){
	        if ($v->id == $user_id){
	            $v->pivot->status = $status;
	            $v->pivot->save();
	        }
	    }
	    return $team->toJson();
	}

}
