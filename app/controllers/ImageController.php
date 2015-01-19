<?php

use Illuminate\Support\Facades\Input;
class ImageController extends BaseController {
	
	public function store()
	{
	    $fn = time().'.jpg';
	    $dst = PATH_BASE.'public/files/'.$fn;
	    $img = str_replace('data:image/png;base64,', '', Input::get('image'));
	    $data = base64_decode($img);
	    file_put_contents($dst, $data);
	    $rt = array('file'=>$fn);
	    return json_encode($rt);
	}
	
}
