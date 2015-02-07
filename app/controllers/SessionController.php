<?php

use Illuminate\Support\Facades\Input;
class SessionController extends BaseController {

	public function index()
	{
        if (!Session::has('uid')){
            return Response::json(array('error'=>1, 'msg'=>'session timeout'));
        }else{
            return User::find(Session::get('uid'));
        }
	}
	
    public function destroy()
    {
        Session::forget('uid');
    }
}
