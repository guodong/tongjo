<?php

use Illuminate\Support\Facades\Input;
class ProjectController extends BaseController {

	public function index()
	{
	    switch (Input::get('orderby')){
	        case 'hot':
	            $projects = Project::orderBy('viewcount', 'desc')->get();
	            break;
	        case 'new':
	            $projects = Project::orderBy('created_at', 'desc')->get();
	            break;
	        default:
	            $projects = Project::orderByRaw("RAND()")->get();
	    }
		
		foreach ($projects as $p){
		    $p->teams;
		    $p->teams_count = $p->teams->count();
		    $p->users;
		    $p->users_count = $p->users->count();
		    $p->description = '';
		};
		return $projects;
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    $project->categorys;
	    $project->creator;
	    $project->creator->school;
	    $project->creator->major;
	    $project->comments;
	    $project->teams;
	    $project->tags;
	    $project->teams->each(function($t){
	        $t->members_count = $t->members->count();
	        $permit_count = 0;
	        foreach ($t->members as $m){
	            if ($m->pivot->status == 'permited'){
	                $permit_count++;
	            }
	        }
	        $t->members_permited_count = $permit_count;
	    });
	    $project->users;
	    foreach ($project->comments as $v){
	        $v->user;
	    }
	    $project->viewcount++;
	    $project->save();
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
	    $project->categorys()->detach();
	    foreach (Input::get('categorys') as $v){
	        $project->categorys()->attach($v);
	    }
	    return $project->toJson();
	}

}
