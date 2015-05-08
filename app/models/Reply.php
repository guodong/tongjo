<?php
class Reply extends BaseModel {
	protected $table = 'reply';
	protected $fillable = array('user_id', 'message_id', 'content');

	public function user()
	{
	    return $this->belongsTo('User');
	}
	
	public function message()
	{
	    return $this->belongsTo('Message');
	}
	
}
