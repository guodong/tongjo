<?php

use Illuminate\Support\Facades\Input;
class TeamUserPivotController extends BaseController {
	
	
	public function store($team_id, $user_id)
	{
	    $team = Team::find($team_id);
	    foreach($team->members as $user){
	        if($user->id == $user_id){
	            return array('error'=>1, 'msg'=>'already exist');
	        }
	    };
	    if ($team->status!=0){
	        return array('error'=>2, 'msg'=>'team completed');
	    }
	    $team->members()->attach($user_id);
	    return $team;
	}
	
	public function update($project_id, $user_id)
	{
	    $project = Project::find($project_id);
	    foreach ($project->users as $v){
	        if ($v->id == $user_id){
	            foreach (Input::get() as $kk=>$vv){
	                $v->pivot->{$kk} = $vv;
	            }
	            $v->pivot->save();
	            break;
	        }
	    }
	    return $project->toJson();
	}

	public function destroy($team_id, $user_id)
	{
	    $team = Team::find($team_id);
	    $team->members()->detach($user_id);
	    return $team;
	}
}
