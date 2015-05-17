<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response as Responses;
class UserInfoController extends BaseController {
	
	// PUT /user/$id
	public function update($userId)
	{
	    //$this->auth($userId);
	    $user = User::find($userId);
	    if ($user)
	    {
	    	$userName = Input::get("userName");
	    	$userGender = Input::get("userGender");
	    	$userUniversity = Input::get("userUniversity");
	    
	 		if ($userName != NULL)
	 		{
	 			$encode = mb_detect_encoding($userName, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
	     		if ($encode == 'EUC-CN')
                    $userName = iconv('GBK', 'UTF-8', $userName);
	 			$user->realname = $userName;
	 		}
	 		if ($userGender != NULL)
	 			$user->gender = $userGender;
	 		if ($userUniversity != NULL)
	 			$user->school_id = $userUniversity;
	    	
	    	$user->save();
	    	return Responses::json(array('result' => array('code' =>0, 'message' => 'no problem')));
	    }
	    else 
	    	return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
	}
	
}
