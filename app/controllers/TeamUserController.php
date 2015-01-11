<?php

use Illuminate\Support\Facades\Input;
class TeamUserController extends BaseController {

	public function index($team_id)
	{
	    $team = Team::find($team_id);
		return $team->members->toJson();
	}
	
	public function show($id)
	{
	    $user = User::find($id);
	    return $user->toJson();
	}
	
	public function store($team_id)
	{
	    $team = Team::find($team_id);
	    $user_id = Input::get('user_id');
	    foreach ($team->members as $user){
	        if ($user->id == $user_id){
	            return json_encode(array('error'=>1, 'msg'=>'already in team'));
	        }
	    }
	    
 	    $team->members()->attach($user_id);
 	    $team->members;
	    return $team->toJson();
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    foreach (Input::get() as $k=>$v){
	        $project->{$k} = $v;
	    }
	    $project->save();
	}

	public function destroy($team_id, $user_id)
	{
	    $team = Team::find($team_id);
	    $team->detach($user_id);
	    return $team->toJson();
	}
}
