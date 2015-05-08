<?php
class Category extends Eloquent {
	protected $table = 'category';
	protected $fillable = array('name', 'user_id', 'type', 'dsc', 'deadline', 'parttype');
	
	public function projects()
	{
	    return $this->belongstoMany('Project', 'project_category');
	}
	
	public function children()
	{
	    return $this->hasMany('Category', 'fid');
	}
	
	public function father()
	{
		return $this->belongsto('Category', 'fid');
	}
}
