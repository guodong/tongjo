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
        foreach ($m->members as $v){
            $v->school;
            $v->major;
        }
        return $m->toJson();
    }

    public function store ()
    {
        $project = Team::create(Input::get());
        return $project->toJson();
    }

    public function update ($id)
    {
        $project = Team::find($id);
        foreach (Input::get() as $k => $v) {
            $project->{$k} = $v;
        }
        $project->save();
    }
}
