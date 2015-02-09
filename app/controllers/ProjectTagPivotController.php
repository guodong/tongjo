<?php

use Illuminate\Support\Facades\Input;
class ProjectTagPivotController extends BaseController {
	
	public function show($id)
	{
	    $project = Project::find($id);
	    return $project->toJson();
	}
	
	public function store($project_id, $tag_id)
	{
	    $project = Project::find($project_id);
	    foreach($project->tags as $tag){
	        if($tag->id == $tag_id){
	            return array('error'=>1, 'msg'=>'already exist');
	        }
	    };
	    $project->tags()->attach($tag_id);
	    return $project;
	}
	
	public function update($project_id, $tag_id)
	{
	    $project = Project::find($project_id);
	    foreach ($project->tags as $v){
	        if ($v->id == $tag_id){
	            foreach (Input::get() as $kk=>$vv){
	                $v->pivot->{$kk} = $vv;
	            }
	            $v->pivot->save();
	            break;
	        }
	    }
	    return $project;
	}

	public function destroy($project_id, $tag_id)
	{
	    $project = Project::find($project_id);
	    $project->tags()->detach($tag_id);
	    return $project;
	}
}
