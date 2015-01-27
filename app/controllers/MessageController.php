<?php

use Illuminate\Support\Facades\Input;
class MessageController extends BaseController {
	
	public function store()
	{
	    return Message::create(Input::get());
	}

}
