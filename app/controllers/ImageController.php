<?php

use Illuminate\Support\Facades\Input;
class ImageController extends BaseController {

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
	    $img = str_replace('data:image/png;base64,', '', Input::get('image'));
	    $data = base64_decode($img);
	    file_put_contents($dst, $data);
	    return json_encode(array('result'=>0, 'path'=>'files/'.$fn));
	}
	
	public function update($id)
	{
	    $project = Project::find($id);
	    $project->update(Input::get());
	    return $project->toJson();
	}

}
