<?php
use Illuminate\Support\Facades\Input;

class FromMessageController extends BaseController
{

    public function index ($from_id)
    {
        $data = Message::where('from_id', '=', $from_id)->get();
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
