<?php
class User extends Eloquent {
	protected $table = 'user';

	protected $hidden = array('password');
	protected $fillable = array('email', 'realname', 'gender');

}
