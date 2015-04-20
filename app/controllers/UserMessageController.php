<?php
use Illuminate\Support\Facades\Input;

class UserMessageController extends BaseController
{

    public function index ($user_id)
    {
        $this->auth($user_id);
        $data = Message::whereRaw("to_id = {$user_id} or from_id = {$user_id}")->orderBy('created_at', 'desc')->get();
        $data->each(function($d){
            $d->from;
            $d->to;
            $d->replies->each(function($r){
                $r->user;
            });
            
        });
        if (Input::get('view')) {
            $data->each(function ($d){
                $d->is_viewed=1;
                $d->save();
            });
        }
        return $data;
    }

}
