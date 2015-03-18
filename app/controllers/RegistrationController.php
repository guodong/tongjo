<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class RegistrationController extends BaseController {
	
	public function store()
	{
		$_POST['password'] = md5($_POST['password']);
		//$user = User::find($_POST);
		//if (json_decode($user) != NULL)
			//return Responses::json(array('result' => array('code' =>2, 'message' => 'problem 2')));
		//else
		//{
	    	$user = User::create($_POST);
			if (isset($user->email) && isset($user->password))
			{
				$user->hxid = "hx_".(string)$user->id;
				$url = "https://a1.easemob.com/easemob-demo/chatdemoui/token";
				$get_token = array();
				$get_token['grant_type'] = "client_credentials";
				$get_token['client_id'] = "YXA6VP5zQMolEeS6LregkdHd4g";
				$get_token['client_secret'] = 'YXA6OuKmp8eotsVaUYdbcLRqYCIkbik';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $get_token);
				$output = curl_exec($ch);
				curl_close($ch);
				return $output;
				
				
				if (isset($user->hxid))
				return Responses::json(array(
							'result' => array(
							'code' =>0, 'message' => 'no problem'),
							'userId' => $user->id
							));
			}
			else 
			{
				return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			}
		//}
	}	
}