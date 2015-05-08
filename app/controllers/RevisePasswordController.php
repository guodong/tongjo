<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response as Responses;
class RevisePasswordController extends BaseController {

	public function index()
	{
	    //修改密码
	    //$this->auth(Input::get('userId'));
	    $user = User::find(Input::get('userId'));
	    if ($user->password != Input::get('passwordOld'))
	       return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));   
	    else 
	    {
	    	$user->password = Input::get('passwordNew');
	        $user->save();
	        return Responses::json(array('result' => array('code' =>0, 'message' => 'no problem')));
	    }
	}
}
