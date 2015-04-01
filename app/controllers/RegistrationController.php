<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class RegistrationController extends BaseController {
	
	public function index()
	{
		//$_POST['password'] = md5($_POST['password']);
		//$user = User::find($_POST);
		//if (json_decode($user) != NULL)
			//return Responses::json(array('result' => array('code' =>2, 'message' => 'problem 2')));
		//else
		//{
	    	//$user = User::create($_POST);
			//if (isset($user->email) && isset($user->password))
			//{
				//$user->hxid = "hx_".(string)$user->id;
				/*$url = 'https://a1.easemob.com/easemob-demo/chatdemoui/token';
				$get_token = array();
				$get_token['grant_type'] = 'client_credentials';
				$get_token['client_id'] = 'YXA6VP5zQMolEeS6LregkdHd4g';
				$get_token['client_secret'] = 'YXA6OuKmp8eotsVaUYdbcLRqYCIkbik';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $get_token);
				$output = curl_exec($ch);
				curl_close($ch);
				return $output;*/
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
			print_r($tokenResult);
			echo "/n";
			
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
						curl_setopt($ch, CURLOPT_POST,true);
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
						
				
				//if (isset($user->hxid))
				//return Responses::json(array(
							//'result' => array(
							//'code' =>0, 'message' => 'no problem'),
							//'userId' => $user->id
							//));
			//}
			//else 
			//{
				//return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			//}
		//}
	}	
}