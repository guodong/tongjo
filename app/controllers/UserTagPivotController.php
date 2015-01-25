<?php

use Illuminate\Support\Facades\Input;
class UserTagPivotController extends BaseController {
	
	public function show($id)
	{
	    $user = User::find($id);
	    return $user->toJson();
	}
	
	public function store($user_id, $tag_id)
	{
	    $user = User::find($user_id);
	    foreach($user->tags as $tag){
	        if($tag->id == $tag_id){
	            return array('error'=>1, 'msg'=>'already exist');
	        }
	    };
	    $user->tags()->attach($tag_id);
	    return $user;
	}
	
	public function update($user_id, $tag_id)
	{
	    $user = User::find($user_id);
	    foreach ($user->tags as $v){
	        if ($v->id == $tag_id){
	            foreach (Input::get() as $kk=>$vv){
	                $v->pivot->{$kk} = $vv;
	            }
	            $v->pivot->save();
	            break;
	        }
	    }
	    return $user;
	}

	public function destroy($user_id, $tag_id)
	{
	    $team = User::find($user_id);
	    $team->tags()->detach($tag_id);
	    return $team;
	}
}
