<?php
use Illuminate\Support\Facades\Input;
class ProjectTagController extends BaseController {
	
	public function index($id)
	{
	    $project = Project::find($id);
	    return $project->tags;
	}
	
}
