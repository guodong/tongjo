<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class RegistrationController extends BaseController {
	
	public function store()
	{
		$user = User::find($_POST);
		if (json_decode($user) != NULL)
			return Responses::json(array('result' => array('code' =>2, 'message' => 'problem 2')));
		else
		{
			//$_POST['hxusername'] = "hx_" . $_POST['email'];
			//$_POST['password'] = $_POST['password'];
	    	$user = User::create($_POST);  	
			if (isset($user->email) && isset($user->password))
			{
				$user->hxusername = "hx_".(string)$user->id;
				$user->hxpassword = $user->password;
				$user->save();
				function _curl_request($url, $body, $header = array(), $method = "POST")
				{
					array_push($header, 'Accept:application/json');
					array_push($header, 'Content-Type:application/json');
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
					switch ($method){
						case "GET" :
							curl_setopt($ch, CURLOPT_HTTPGET, true);
							break;
						case "POST":
							curl_setopt($ch, CURLOPT_POST, true);
							break;
						case "PUT" :
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
							break;
						case "DELETE":
							curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
							break;
					}
					
					curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
					curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
					if (isset($body{3}) > 0) {
						curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
					}
					if (count($header) > 0) {
						curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					}
					$ret = curl_exec($ch);
					$err = curl_error($ch);
					curl_close($ch);
					if ($err) {
						return $err;
					}
					return $ret;
				}
			
				$formgettoken="https://a1.easemob.com/easemob-demo/chatdemoui/token";
				$body=array(
						"grant_type"=>"client_credentials",
						"client_id"=>"YXA6VP5zQMolEeS6LregkdHd4g",
						"client_secret"=>"YXA6OuKmp8eotsVaUYdbcLRqYCIkbik"
				);
				$patoken=json_encode($body);
				$res = _curl_request($formgettoken,$patoken);
				$tokenResult = array();
				$tokenResult =  json_decode($res, true);
				$access_token = $tokenResult['access_token'];
				
				$formauthreg="https://a1.easemob.com/easemob-demo/chatdemoui/users";
				$regbody=array(
						"username"=>$user->hxusername,
						"password"=>$user->hxpassword
				);
				$pareg=json_encode($regbody);
				
				$header = array();
				array_push($header, 'Accept:application/json');
				array_push($header, 'Content-Type:application/json');
				array_push($header, $access_token);	
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
				curl_setopt($ch, CURLOPT_URL, $formauthreg);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'SSTS Browser/1.0');
				curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
				if (isset($pareg{2}) > 0) {
					curl_setopt($ch, CURLOPT_POSTFIELDS, $pareg);
				}
				if (count($header) > 0) {
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				}
				$ret = curl_exec($ch);
				$err = curl_error($ch);
				curl_close($ch);
				if ($err) {
					return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
				}
				$res = json_decode($ret, true);
				if ($res['entities'] != NULL)
					return Responses::json(array(
					'result' => array(
					'code' =>0, 'message' => 'no problem',
					'userId' => $user->id
					)));
			}
			else 
				return Responses::json(array('result' => array('code' =>2, 'message' => 'problem 2')));
		}
	}	
}