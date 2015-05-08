<?php
class Experience extends BaseModel {
	protected $table = 'experience';
	protected $fillable = array('from', 'to', 'user_id','content');

	public function user()
	{
	    return $this->belongsTo('User');
	}
	
}
