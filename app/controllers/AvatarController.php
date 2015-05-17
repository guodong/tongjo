<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response as Responses;
class AvatarController extends BaseController {
	
	public function store()
	{
		$user = User::find($_POST["userId"]);
		return $user;
		$post_input = 'php://input';
	    $save_path = PATH_BASE.'public/files/';
	    $postdata = file_get_contents( $post_input );
	    return $postdata;
	    
	    if ( isset( $postdata ) && strlen( $postdata ) > 0 ) {
	        $fn = uniqid() . '.jpg';
	        $filename = $save_path . $fn;
	        $handle = fopen( $filename, 'w+' );
	        fwrite( $handle, $postdata );
	        fclose( $handle );
	        if ( is_file( $filename ) ) {
	        	$user = User::find($_POST["userId"]);
	        	$user->avatar = $fn;
	        	$user->save();
	            return Responses::json(array('result' => array('code' =>0, 'message' => 'no problem')));
	            exit ();
	        }else {
	            die ( 'Image upload error!' );
	        }
	    }else {
	        die ( 'Image data not detected!' );
	    }
	    
	    return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
	    $fn = time().'.jpg';
	    $dst = PATH_BASE.'public/files/'.$fn;
	    $img = str_replace('data:image/png;base64,', '', Input::get('userImage'));
	    $data = base64_decode($img);
	    file_put_contents($dst, $data);
	    $user = User::find($_POST["userId"]);
	    $user->avatar = $fn;
	    $user->save();
	    return $user;
	}
	
}
