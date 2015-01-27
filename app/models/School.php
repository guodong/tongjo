<?php
class School extends Eloquent {
	protected $table = 'school';
	
	public function campuses()
	{
	    return $this->hasMany('Campus');
	}
}
