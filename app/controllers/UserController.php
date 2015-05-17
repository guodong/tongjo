<?php

use Illuminate\Support\Facades\Input;
class UserController extends BaseController {

    // GET /user
	public function index()
	{
		$users = User::all();
		return $users->toJson();
	}
	
	// GET /user/$id
	public function show($id)
	{
	    $user = User::find($id);
	    if($user){
	        $user->school;
	        $user->major;
	        $user->tags;
	        return $user;
	    }else{
	        return json_encode(array('error'=>1, 'msg'=>'no user'));
	    }
	}

	// POST /user
	public function store()
	{
	    $u = User::where('email', '=', $_POST['email'])->first();
	    if($u){
	        echo 1;
	        return;
	    }
	    $_POST['password'] = md5($_POST['password']);
	    $_POST['email_verify_code'] = uniqid();
	    $_POST['realname'] = '同志'.rand(1, 9999);
	    $_POST['avatar'] = 'sysavatar/'.rand(1, 40).'.jpg';
	    $user = User::create($_POST);
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
	    	
	    $formgettoken="https://a1.easemob.com/tongjo/tongjo/token";
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
	    
	    $formauthreg="https://a1.easemob.com/tongjo/tongjo/users";
	    $regbody=array(
	    		"username"=>$user->hxusername,
	    		"password"=>$user->hxpassword
	    );
	    $pareg=json_encode($regbody);
	    
	    $header = array();
	    array_push($header, 'Accept:application/json');
	    array_push($header, 'Content-Type:application/json');
	    array_push($header, "Authorization: Bearer " . $access_token);
	    
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
	    
	    Mail::send('emails.auth.register', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message) use ($user)
	    {
	        $message->to($user->email, '您好')->subject('欢迎加入同舟!');
	    });
	    return $user->toJson();
	}
	
	// PUT /user/$id
	public function update($id)
	{
	    $this->auth($id);
	    $user = User::find($id);
	    foreach (Input::get() as $k=>$v){
	        if (is_string($v) || is_numeric($v)){
	            $user->{$k} = $v;
	            //echo $user->realname;
	        }
	    }
	    //echo $user->realname;
	    $user->save();
	    return $user->toJson();
	}
	
	public function resetpassword()
	{
	    //找回密码
	    if (Input::get('code')){
	        $user = User::find(Input::get('uid'));
	        $user->password = md5(Input::get('newpsw'));
	        $user->save();
	        return 0;
	    }
	    //修改密码
	    $this->auth(Input::get('uid'));
	    $user = User::find(Input::get('uid'));
	    if ($user->password != md5(Input::get('oldpsw'))){
	        return 1;
	    }
	    $user->password = md5(Input::get('newpsw'));
	    $user->save();
	    return 0;
	}
	
	public function findpassword()
	{
	    $user = User::where('email', '=', Input::get('email'))->first();
	    if ($user){
	        if (!$user->email_verify_code){
	            $user->email_verify_code = uniqid();
	            $user->save();
	        }
	        Mail::send('emails.auth.findpsw', array('id' => $user->id, 'code'=>$user->email_verify_code), function($message) use ($user)
	        {
	            $message->to($user->email, '您好')->subject('同舟密码重置');
	        });
	        return 1;
	    }
	}
}
