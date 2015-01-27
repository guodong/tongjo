<?php
use Illuminate\Support\Facades\Input;
class UserTagController extends BaseController {
	
	public function index($id)
	{
	    $user = User::find($id);
	    return $user->tags;
	}
	
}
