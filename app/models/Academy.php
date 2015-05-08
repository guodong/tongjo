<?php
class Academy extends BaseModel {
	protected $table = 'school';
	public function majors()
	{
	    return $this->hasMany('Major', 'fid');
	}
}
