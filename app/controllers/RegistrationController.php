<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class RegistrationController extends BaseController {
	
	public function store()
	{
		$_POST['password'] = md5($_POST['password']);
	    $user = User::create($_POST);
		if (isset($user->email) && isset($user->password))
			return Responses::json(array(
					'result' => array(
							'code' =>0, 'message' => 'no problem'),
					'userId' => $user->id
					));
		else 
		{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}	
}