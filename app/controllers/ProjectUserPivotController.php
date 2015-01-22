<?php

use Illuminate\Support\Facades\Input;
class ProjectUserPivotController extends BaseController {
	
	public function show($id)
	{
	    $user = User::find($id);
	    return $user->toJson();
	}
	
	public function store($project_id, $user_id)
	{
	    $project = Project::find($project_id);
	    foreach($project->users as $user){
	        if($user->id == $user_id){
	            return array('error'=>1, 'msg'=>'already exist');
	        }
	    };
	    $project->users()->attach($user_id);
	    return $project;
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

	public function destroy($project_id, $user_id)
	{
	    $team = Project::find($project_id);
	    $team->users()->detach($user_id);
	    return $team;
	}
}
