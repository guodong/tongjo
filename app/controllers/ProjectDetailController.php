<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;
class LoginController extends BaseController {

	public function show($id)
	{
		$project = Project::find($id);
		if($project){
			$response = array('result' => array('code' =>0, 'message' => 'no problem'), 'projectDetail' => array('info' => array('projectId' => $project->id, 'projectName' => $project->name, 'projectImage' => $project->pic, 'projectCreatedDate' => $project->created_at, 'projectEndDate' => $project->deadline, 'projectFounderId' => $project->user_id, 'projectFounderName' => $project->type, 'projectLable' => $project->type, 'projectText' => $project->description), 
							  'commment' => array('userId'=>$user->id, 'email'=>$user->email, 'realName'=>$user->realname, 'gender'=>$user->gender),
							  'team' => array())
							  );
			return json_encode($response);
		}else{
			return json_encode(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}

}