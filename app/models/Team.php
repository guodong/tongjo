<?php
class Team extends Eloquent {
	protected $table = 'team';

	protected $fillable = array('name', 'user_id', 'project_id', 'is_solo', 'teammember_all', 'teammember_current', 'description', 'is_signup', 'signup_time', 'status');
	
	public function project()
	{
	    return $this->belongsTo('Project');
	}
	
	public function members()
	{
	    return $this->belongsToMany('User', 'user_team')->withTimestamps()->withPivot('status');
	}
	
	public function creator()
	{
	    return $this->belongsTo('user', 'user_id');
	}

	
}
