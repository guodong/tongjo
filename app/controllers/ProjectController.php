<?php

use Illuminate\Support\Facades\Input;
class ProjectController extends BaseController {

	public function index()
	{
		$projects = Project::all();
		foreach ($projects as $p){
		    $p->teams;
		    $p->teams_count = $p->teams->count();
		    $p->users;
		    $p->users_count = $p->users->count();
		};
		return $projects;
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    $project->categorys;
	    $project->creator;
	    $project->comments;
	    $project->teams;
	    $project->tags;
	    $project->teams->each(function($t){
	        $t->members_count = $t->members->count();
	    });
	    $project->users;
	    foreach ($project->comments as $v){
	        $v->user;
	    }
	    
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
	    $this->auth($project->creator_id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
