<?php
use Illuminate\Support\Facades\Input;

class ToMessageController extends BaseController
{

    public function index ($from_id)
    {
        $this->auth($from_id);
        $data = Message::where('to_id', '=', $from_id)->orderBy('created_at', 'desc')->get();
        $data->each(function($d){
            $d->from;
            $d->to;
        });
        return $data;
    }

    public function store ()
    {
        $team = Message::create(Input::get());
        return $team;
    }
    
}
