<?php

use Illuminate\Support\Facades\Input;
class ProjectController extends BaseController {

	public function index()
	{
		$projects = Project::all();
		return $projects->toJson();
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    return $project->toJson();
	}
	
	public function store()
	{
	    $project = Project::create(Input::get());
	    foreach (Input::get('categorys') as $v){
	        $project->categorys()->attach($v);
	    }
	    //$project->categorys()-sync(Input::get('categorys'));
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