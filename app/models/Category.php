<?php
class Category extends Eloquent {
	protected $table = 'category';
	
	public function projects()
	{
	    return $this->belongsToMany('Project', 'project_category');
	}
	
	public function children()
	{
	    return $this->hasMany('Category', 'fid');
	}
}
