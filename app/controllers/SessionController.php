<?php

use Illuminate\Support\Facades\Input;
class SessionController extends BaseController {

	public function index()
	{
        if (empty($_SESSION['uid'])){
            return Response::json(array('error'=>1, 'msg'=>'session timeout'));
        }else{
            return User::find($_SESSION['uid']);
        }
	}
	

}
