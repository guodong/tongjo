<?php

use Illuminate\Support\Facades\Input;
class TagController extends BaseController {
    
    private function loop($tag){
        if (!$tag->children->count()) {
            return ;
        }
        $tag->children->each(function($child){
            $this->loop($child);
        });
    }

	public function index()
	{
	    if (Input::get('tree')){
	        $t = Tag::where('fid', '=', '0')->get();
	        $t->each(function($tag){
	            $this->loop($tag);
	        });
	        return $t;
	    }
	    return Tag::all();
	}
	
	public function show($id)
	{
	    return Tag::find($id);
	}

}
