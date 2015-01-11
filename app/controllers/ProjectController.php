<?php

use Illuminate\Support\Facades\Input;
class ProjectController extends BaseController {

	public function index()
	{
		$projects = Project::all();
		return $projects;
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    $project->categorys;
	    $project->creator;
	    
	    return $project->toJson();
	}
	
	public function store()
	{
	    $project = Project::create(Input::get());
	    foreach (Input::get('categorys') as $v){
	        $project->categorys()->attach($v);
	    }
	    return $project->toJson();
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
