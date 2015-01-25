<?php
use Illuminate\Support\Facades\Input;

class TeamController extends BaseController
{

    public function index ()
    {
        $cates = Team::all();
        return $cates->toJson();
    }

    public function show ($id)
    {
        $m = Team::find($id);
        $m->members;
        $m->creator;
        foreach ($m->members as $v){
            $v->school;
            $v->major;
        }
        $m->project;
        $m->members_count = $m->members->count();
        return $m->toJson();
    }

    public function store ()
    {
        $team = Team::create(Input::get());
        
        $team->members()->attach(Input::get("user_id"), array('status' => 'permited'));
        return $team;
    }

    public function update ($id)
    {
        $data = Team::find($id);
	    $data->update(Input::get());
	    $data->members;
        return $data;
    }
    
    
}
