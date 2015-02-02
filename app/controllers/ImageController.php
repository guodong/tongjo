<?php

use Illuminate\Support\Facades\Input;
class ImageController extends BaseController {
	
	public function store()
	{
	    /* $post_input = 'php://input';
	    $save_path = PATH_BASE.'public/files/';
	    $postdata = file_get_contents( $post_input );
	    
	    if ( isset( $postdata ) && strlen( $postdata ) > 0 ) {
	        $fn = uniqid().'.jpg';
	        $filename = $save_path . $fn;
	        $handle = fopen( $filename, 'w+' );
	        fwrite( $handle, $postdata );
	        fclose( $handle );
	        if ( is_file( $filename ) ) {
	            return json_encode(array('file'=>$fn));
	            exit ();
	        }else {
	            die ( 'Image upload error!' );
	        }
	    }else {
	        die ( 'Image data not detected!' );
	    }
	    return; */
	    $fn = time().'.jpg';
	    $dst = PATH_BASE.'public/files/'.$fn;
	    $img = str_replace('data:image/png;base64,', '', Input::get('image'));
	    $data = base64_decode($img);
	    file_put_contents($dst, $data);
	    $rt = array('file'=>$fn);
	    return json_encode($rt);
	}
	
}
