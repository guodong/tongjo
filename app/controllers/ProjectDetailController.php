<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class ProjectDetailController extends BaseController {

	public function index()
	{
		//$project = Project::find($id);
		$project = Project::whereRaw('id = ?', array(Input::get('projectId')))->first();
		$teams = $project->teams;
		$creator = $project->creator;
		$latestTeam = $teams->sortBy('created_at')->last();
		$projectFounderUniversity = School::find($creator->school_id);
		if ($latestTeam)
		{
			$latestTeamFounder = User::find($latestTeam->user_id);
			$latestTeamFounderSchool = School::find($latestTeamFounder->school_id);
		}
		if($project){
			if ($latestTeam) 
			{
				$response = array('result' => array('code' =>0, 'message' => 'no problem'), 'projectDetail' => array(
							  'info' => array(
							  		'projectID' => $project->id, 
							  		'projectName' => $project->name, 
							  		'projectImage' => $project->image, 
							  		'projectCreatedDate' => date($project->created_at), 
							  		'projectEndDate' => $project->deadline, 
							  		'projectFounderId' => $project->user_id, 
							  		'projectFounderName' => $creator->realname, 
							  		'projectFounderImage' => $creator->avatar, 
							  		'projectFounderUniversityId' => $projectFounderUniversity->id,
							  		'projectFounderUniversityName' => $projectFounderUniversity->name,
							  		'projectLable' => $project->type, 
							  		'projectText' => $project->description), 
							  'comment' => array('commentCount'=> 0),
							  'team' => array(
							  		'teamCount' => count($teams),
							  		'latestTeamFounderId' => $latestTeam->user_id, 
							  		'latestTeamName'=> $latestTeam->name, 
							  		'latestTeamFounderName' => $latestTeamFounder->realname, 
							  		'latestTeamFounderIamge' => $latestTeamFounder->avatar, 
							  		'latestTeamFounderSchool' => $latestTeamFounderSchool->name, 
							  		'latestTeamDate' => date($latestTeam->created_at), 
							  		'latestTeamMemberAll' => $latestTeam->teammember_all, 
							  		'latestTeamMemberNow' => $latestTeam->teammember_current))										
							  );
				return Responses::json($response);
			}
			else
			{
				$response = array('result' => array('code' =>0, 'message' => 'no problem'), 'projectDetail' => array(
						'info' => array(
								'projectID' => $project->id,
								'projectName' => $project->name,
								'projectImage' => $project->image,
								'projectCreatedDate' => date($project->created_at),
								'projectEndDate' => $project->deadline,
								'projectFounderId' => $project->user_id,
								'projectFounderName' => $creator->realname,
								'projectFounderImage' => $creator->avatar,
								'projectFounderUniversityId' => $projectFounderUniversity->id,
								'projectFounderUniversityName' => $projectFounderUniversity->name,
								'projectLable' => $project->type,
								'projectText' => $project->description),
						'comment' => array('commentCount'=> 0),
						'team' => array('teamCount' => count($teams)))
								);
						return Responses::json($response);
			}
		}else{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}