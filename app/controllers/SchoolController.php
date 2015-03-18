<?php

use Illuminate\Support\Facades\Input;
class SchoolController extends BaseController {

	public function index()
	{
	    $schools = School::where('fid','=','0')->get();
	    foreach ($schools as $v){
	        $v->academies->each(function($academy){
	            $academy->majors;
	        });
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
