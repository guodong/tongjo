<?php
class Tag extends Eloquent {
	protected $table = 'tag';
	protected $fillable = array('name');
	
	public function users()
	{
	    return $this->belongsToMany('User', 'user_tag');
	}
	
	public function children()
	{
	    return $this->hasMany('Tag', 'fid');
	}
}
