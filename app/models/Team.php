<?php
class Team extends Eloquent {
	protected $table = 'team';

	protected $fillable = array('name', 'user_id', 'teammember_all', 'teammember_current', 'description', 'is_signup', 'signup_time');
	
	public function project()
	{
	    return $this->belongsTo('Project');
	}
	
	public function members()
	{
	    return $this->belongsToMany('User', 'user_team')->withTimestamps();;
	}

}
