<?php
class School extends BaseModel {
	protected $table = 'school';
	
	public function academies()
	{
	    return $this->hasMany('Academy', 'fid');
	}
	
}
