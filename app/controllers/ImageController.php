<?php

use Illuminate\Support\Facades\Input;
class MajorController extends BaseController {

	public function index()
	{
	    return Major::all()->toJson();
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    $project->categorys;
	    return $project->toJson();
	}
	
	public function store()
	{
	    $fn = time().'.jpg';
	    $dst = PATH_BASE.'public/files/'.$fn;
	    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
	    return json_encode(array('result'=>0, 'path'=>'/files/'.$fn));
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
