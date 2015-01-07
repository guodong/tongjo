<?php
class User extends Eloquent {
	protected $table = 'user';

	protected $hidden = array('password');
	protected $fillable = array('email', 'password', 'realname', 'gender');
	
	public function createdTeams()
	{
	    return $this->hasMany('Team');
	}
	
	public function joinedTeams()
	{
	    return $this->belongsToMany('Team', 'user_team');
	}
    
	public function createdProjects()
	{
	    return $this->hasMany('Project');
	}
	
	public function major()
	{
	    return $this->belongsTo('Major');
	}

	public function school()
	{
	    return $this->belongsTo('School');
	}
}
