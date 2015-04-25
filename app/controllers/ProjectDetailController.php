<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class ProjectDetailController extends BaseController {

	public function index()
	{
		//$project = Project::find($id);
		$project = Project::whereRaw('id = ?', array(Input::get('projectId')))->first();
		$teams = $project->teams;
		$comments = $project->comments;
		$creator = $project->creator;
		$latestTeam = $teams->sortBy('created_at')->last();
		$latestComment = $comments->sortBy('created_at')->last();
		$projectFounderUniversity = School::find($creator->school_id);
		if ($latestTeam)
		{
			$latestTeamFounder = User::find($latestTeam->user_id);
			$latestTeamFounderSchool = School::find($latestTeamFounder->school_id);
		}
		if($project)
		{
			if ($latestTeam) 
			{
				if ($latestComment)
				{	
					$response = array('result' => array('code' =>0, 'message' => 'no problem'), 
							  'info' => array(
							  		'projectId' => $project->id, 
							  		'projectName' => $project->name, 
							  		'projectImage' => $project->image, 
							  		'projectCreatedDate' => date($project->created_at), 
							  		'projectEndDate' => $project->deadline, 
							  		'projectFounderId' => $project->user_id, 
							  		'projectFounderName' => $creator->realname, 
							  		'projectFounderImage' => $creator->avatar, 
							  		'projectFounderUniversityId' => $projectFounderUniversity->id,
							  		'projectFounderUniversityName' => $projectFounderUniversity->name,
							  		'projectLabel' => $project->categorys->first()->name,
							  		'projectText' => strip_tags($project->description), 
									'teamNumber' => count($teams),
									'commentNumber' => count($comments)),
							  'comment' => array(
							  		'commentUserId'=> $latestComment->user_id,
							  		'commentUserName' => User::find($latestComment->user_id)->realname,
							  		'commentUserImage' => User::find($latestComment->user_id)->avatar,
							  		'commentText' => $latestComment->content,
							  		'commentDate' => date($latestComment->created_at)),	  		
							  'team' => array(
							  		'teamId' => $latestTeam->id,
							  		'projectId' => $project->id, 
							  		'teamFounderId' => $latestTeam->user_id, 
							  		'teamName'=> $latestTeam->name, 
							  		'teamFounderName' => $latestTeamFounder->realname, 
							  		'teamFounderImage' => $latestTeamFounder->avatar, 
							  		'teamFounderSchool' => $latestTeamFounderSchool->name, 
							  		'teamCreatedDate' => date($latestTeam->created_at), 
							  		'teamMemberAll' => $latestTeam->teammember_all, 
							  		'teamMemberNow' => count($latestTeam->members),
							  		'teamDeadlineDate' => date($latestTeam->signup_time),
							  		'teamDescription' => $latestTeam->description)										
							  );
					return Responses::json($response);
				}
				else 
				{
					$response = array('result' => array('code' =>0, 'message' => 'no problem'),
							'info' => array(
									'projectId' => $project->id,
									'projectName' => $project->name,
									'projectImage' => $project->image,
									'projectCreatedDate' => date($project->created_at),
									'projectEndDate' => $project->deadline,
									'projectFounderId' => $project->user_id,
									'projectFounderName' => $creator->realname,
									'projectFounderImage' => $creator->avatar,
									'projectFounderUniversityId' => $projectFounderUniversity->id,
									'projectFounderUniversityName' => $projectFounderUniversity->name,
									'projectLabel' => $project->categorys->first()->name,
									'projectText' => strip_tags($project->description),
									'teamNumber' => count($teams),
									'commentNumber' => 0),
							'team' => array(
									'teamId' => $latestTeam->id,
									'projectId' => $project->id,
									'teamFounderId' => $latestTeam->user_id,
									'teamName'=> $latestTeam->name,
									'teamFounderName' => $latestTeamFounder->realname,
									'teamFounderImage' => $latestTeamFounder->avatar,
									'teamFounderSchool' => $latestTeamFounderSchool->name,
									'teamCreatedDate' => date($latestTeam->created_at),
									'teamMemberAll' => $latestTeam->teammember_all,
									'teamMemberNow' => count($latestTeam->members),
									'teamDeadlineDate' => date($latestTeam->signup_time),
							  		'teamDescription' => $latestTeam->description)
					);
					return Responses::json($response);
				}
			}
			else
			{
				if ($latestComment)
				{
					$response = array('result' => array('code' =>0, 'message' => 'no problem'),
							'info' => array(
									'projectId' => $project->id,
									'projectName' => $project->name,
									'projectImage' => $project->image,
									'projectCreatedDate' => date($project->created_at),
									'projectEndDate' => $project->deadline,
									'projectFounderId' => $project->user_id,
									'projectFounderName' => $creator->realname,
									'projectFounderImage' => $creator->avatar,
									'projectFounderUniversityId' => $projectFounderUniversity->id,
									'projectFounderUniversityName' => $projectFounderUniversity->name,
									'projectLabel' => $project->categorys->first()->name,
									'projectText' => strip_tags($project->description),
									'teamNumber' => 0,
									'commentNumber' => count($comments)),
							'comment' => array(
							  		'commentUserId'=> $latestComment->user_id,
							  		'commentUserName' => User::find($latestComment->user_id)->realname,
							  		'commentUserImage' => User::find($latestComment->user_id)->avatar,
							  		'commentText' => $latestComment->content,
							  		'commentDate' => date($latestComment->created_at)),		
								);
						return Responses::json($response);
				}
				else 
				{
					$response = array('result' => array('code' =>0, 'message' => 'no problem'),
							'info' => array(
									'projectId' => $project->id,
									'projectName' => $project->name,
									'projectImage' => $project->image,
									'projectCreatedDate' => date($project->created_at),
									'projectEndDate' => $project->deadline,
									'projectFounderId' => $project->user_id,
									'projectFounderName' => $creator->realname,
									'projectFounderImage' => $creator->avatar,
									'projectFounderUniversityId' => $projectFounderUniversity->id,
									'projectFounderUniversityName' => $projectFounderUniversity->name,
									'projectLabel' => $project->categorys->first()->name,
									'projectText' => strip_tags($project->description),
									'teamNumber' => 0,
									'commentNumber' => 0),
					);
					return Responses::json($response);
				}
			}
		}else{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}