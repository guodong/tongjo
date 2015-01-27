<?php
use Illuminate\Support\Facades\Input;
class UserTagPivotController extends BaseController {
	
	public function show($id)
	{
	    $user = User::find($id);
	    return $user->tags;
	}
	
}
