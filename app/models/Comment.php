<?php
class Comment extends BaseModel {
	protected $table = 'comment';
	protected $fillable = array('user_id', 'project_id', 'content');

	public function project()
	{
	    return $this->belonsTo('Project');
	}
	
	public function user()
	{
	    return $this->belongsTo('User');
	}
	
}
