<?php

use Illuminate\Support\Facades\Input;
class CategoryProjectController extends BaseController {

	public function index($category_id)
	{
	    $category = Category::find($category_id);
	    $projects = [];
	    if (count($category->children)){
	        foreach ($category->children as $c){
	            $projects = array_merge($projects, $this->index($c->id));
	        }
	    }else{
	        $projects = $category->projects->toArray();
	    }
	    return $projects;
	}
	
	public function show($id)
	{
	    $project = Project::find($id);
	    return $project->toJson();
	}
	
	public function store()
	{
	    $project = Project::create(Input::get());
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
