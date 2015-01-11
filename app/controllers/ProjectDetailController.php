<?php
use Illuminate\Support\Facades\Response as Responses;

class ProjectDetailController extends BaseController {

	public function show($id)
	{
		$project = Project::find($id);
		$teams = $project->showteams;
		if($project){
			$response = array('result' => array('code' =>0, 'message' => 'no problem'), 'projectDetail' => array('info' => array('projectId' => $project->id, 'projectName' => $project->name, 'projectImage' => $project->pic, 'projectCreatedDate' => $project->created_at, 'projectEndDate' => $project->deadline, 'projectFounderId' => $project->user_id, 'projectFounderName' => $project->type, 'projectLable' => $project->type, 'projectText' => $project->description), 
							  'commment' => array('commentCount'=> 0),
							  'team' => array($teams->toJson()))
							  //'team' => array('teamCount' => , 'latestTeamFounderId' => , 'latestTeamFounderName' => , 'latestTeamFounderImage' => , 'latestTeamFounderSchool' => , 'latestTeamDate' => ,'latestTeamMemberAll' => , 'latestTeamMemberNow' => ,))
							  );
			return Responses::json($response);
		}else{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}

}