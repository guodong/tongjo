<?php
class Academy extends Eloquent {
	protected $table = 'school';
	public function majors()
	{
	    return $this->hasMany('Major', 'fid');
	}
}
