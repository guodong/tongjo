<?php
class User extends BaseModel {
	protected $table = 'user';

	protected $hidden = array('password', 'email_verify_code');
	protected $fillable = array('email', 'password', 'realname', 'avatar', 'gender', 'email_verify_code', 'school_id', 'academy_id', 'major_id');
	
	public function createdTeams()
	{
	    return $this->hasMany('Team');
	}
	
	public function joinedTeams()
	{
	    return $this->belongsToMany('Team', 'user_team')->withPivot('status');
	}
    
	public function createdProjects()
	{
	    return $this->hasMany('Project');
	}
	
	// 参加的项目，只包含个人参加
	public function joinedProjects()
	{
	    return $this->belongsToMany('Project', 'user_project')->withPivot('status');
	}
	
	public function major()
	{
	    return $this->belongsTo('Major');
	}

	public function school()
	{
	    return $this->belongsTo('School');
	}
	
	public function academy()
	{
	    return $this->belongsTo('Academy');
	}
	
	public function tags()
	{
	    return $this->belongsToMany('Tag', 'user_tag');
	}
	
	public function experiences()
	{
	    return $this->hasMany('Experience');
	}
}
