<?php

use Illuminate\Support\Facades\Input;
class SchoolController extends BaseController {

	public function index()
	{
	    $schools = School::all();
	    foreach ($schools as $v){
	        $v->campuses;
	    }
	    return $schools->toJson();
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    $project->categorys;
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
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
