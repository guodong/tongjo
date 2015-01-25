<?php
use Illuminate\Support\Facades\Input;

class UserTagController extends BaseController
{

    public function index ($user_id)
    {
        $user = User::find($user_id);
        return $user->tags;
    }

}
