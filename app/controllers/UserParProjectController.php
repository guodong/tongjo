<?php

use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;
class UserParProjectController extends BaseController {
	
	public function index()
	{
		$user_id = (int)Input::get("userId");	
		$user = User::find($user_id);
		if ($user){
			$projects = $user->joinedProjects;
			$projectList = [];
			for ($i = 0 ; $i < count($projects); $i++)
			{
				if ($projects[$i]->categorys!= NULL && $projects[$i]->categorys->first()->fid != 0 && $projects[$i]->id != 0)
				{
					$projectList[$i] = array( 'projectId' => $projects[$i]->id,
							'projectName' => $projects[$i]->name,
							'projectImage' => $projects[$i]->image,
							'projectCreatedDate' => date($projects[$i]->created_at),
							'projectEndDate' => $projects[$i]->deadline,
							'projectFounderId' => $projects[$i]->user_id,
							'projectFounderName' => $projects[$i]->creator->realname,
							'projectFounderImage' => $projects[$i]->creator->avatar,
							'projectFounderUniversityId' => $projects[$i]->creator->school_id,
							'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
							'projectLabel' => Category::find($projects[$i]->categorys->first()->fid)->name,
							'projectText' => $projects[$i]->description,
							'teamNumber' => count($projects[$i]->teams),
							'commentNumber' => count($projects[$i]->comments));
				}
			}
			$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
								   'count' => count($projects),
							       'projectList' => $projectList);
				return Responses::json($response);
		}else{
			return json_encode(array('error'=>1, 'msg'=>'no user'));
		}
	}
	
	public function store()
	{
		$user_id = (int)Input::get("userId");	
		$project_id = (int)Input::get("projectId"); 
		$project = Project::find($project_id);
	    foreach($project->users as $user){
	        if($user->id == $user_id){
	            return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
	        }
	    };
	    $project->users()->attach($user_id);
	    return Responses::json(array('result' => array('code' =>0, 'message' => 'no problem')));;
	}

}
