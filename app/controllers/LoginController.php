<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
class AccesstokenController extends BaseController {

	public function index()
	{
		/*Login test*/
		$result = array('result' => true, 'message' => 'no problem', 'user' => array('userId'=>1, 'email'=>'pt@tongjo.com', 'realName'=>'彭涛', 'gender'=>1));
		$jsonstring = json_encode($result);
		header('Content-Type: application/json');
		echo $jsonstring;
	}

}