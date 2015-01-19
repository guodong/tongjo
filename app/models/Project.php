<?php
class Project extends Eloquent {
	protected $table = 'project';
	protected $fillable = array('name', 'user_id', 'type', 'image', 'description', 'sponsor', 'deadline', 'parttype', 'is_open');

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
	
	//个人参加的用户
	public function users()
	{
	    return $this->belongsToMany('User', 'user_project')->withTimestamps();
	}
}
