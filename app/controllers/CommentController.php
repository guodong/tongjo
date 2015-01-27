<?php

use Illuminate\Support\Facades\Input;
class CommentController extends BaseController {

	public function show($id)
	{
        return Comment::find($id);
	}
	
	public function store()
	{
	    return Comment::create(Input::get());
	}
	
}
