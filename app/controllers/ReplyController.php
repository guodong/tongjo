<?php

use Illuminate\Support\Facades\Input;
class ReplyController extends BaseController {
	
	public function store()
	{
	    $project = Reply::create(Input::get());
	    return $project;
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
