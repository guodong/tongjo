<?php
class School extends Eloquent {
	protected $table = 'school';
	
	public function academies()
	{
	    return $this->hasMany('Academy', 'fid');
	}
	
}
