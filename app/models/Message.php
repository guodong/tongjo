<?php
class Message extends BaseModel {
	protected $table = 'message';
	protected $fillable = array('from_id', 'to_id', 'title','content');

	public function from()
	{
	    return $this->belongsTo('User');
	}
	
	public function to()
	{
	    return $this->belongsTo('User');
	}

	public function replies()
	{
	    return $this->hasMany('Reply');
	}
}
