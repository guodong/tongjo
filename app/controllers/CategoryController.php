<?php

use Illuminate\Support\Facades\Input;
class CategoryController extends BaseController {

	public function index()
	{
		$cates = Category::where('fid', '=', 0)->get();
		$cates->each(function($cate){
		    $cate->children;
		});
		return $cates->toJson();
	}
	
	public function show($id)
	{
	    $project = Category::find($id);
	    return $project->toJson();
	}
	
	public function store()
	{
	    $project = Category::create(Input::get());
	    return $project->toJson();
	}
	
	public function update($id)
	{
	    $project = Category::find($id);
	    foreach (Input::get() as $k=>$v){
	        $project->{$k} = $v;
	    }
	    $project->save();
	}

}
