<?php
class Project extends Eloquent {
	protected $table = 'project';
	protected $fillable = array('name', 'user_id', 'type', 'dsc', 'deadline', 'parttype');

	public function teams()
	{
	    return $this->hasMany('Team');
	}
	
	public function categorys()
	{
	    return $this->belongsToMany('Category', 'project_category');
	}
	
	public function creator()
	{
	    return $this->belongsTo('User', 'user_id');
	}
	
}
