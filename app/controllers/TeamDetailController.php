<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class TeamDetailController extends BaseController {

	public function index()
	{
		$team = Team::whereRaw('id = ?', array(Input::get('teamId')))->first();
		if ($team)
		{
			$teamFounder = User::find($team->user_id);
			$teamDetail = array(
						'teamId' => $team->id,
						'projectId' => $team->project_id,
						'teamFounderId' => $team->user_id,
						'teamName'=> $team->name,
						'teamFounderName' => $teamFounder->realname,
						'teamFounderImage' => $teamFounder->avatar,
						'teamFounderSchool' => School::find($teamFounder->school_id)->name,
						'teamCreatedDate' => date($team->created_at),
						'teamMemberAll' => $team->teammember_all,
						'teamMemberNow' => (string)count($team->members),
						'teamDeadlineDate' => date($team->signup_time),
						'teamDescription' => $team->description);
			
			$teamMembers = $team->members;
			for ($i = 0; $i <= count($teamMembers)-1; $i++)
			{
				$teamMemberList[$i] = array(
						'userId' => $teamMembers[$i]->id,
				     	'userEmail' => $teamMembers[$i]->email,
						'userRealName' => $teamMembers[$i]->realname,
						'userGender' => $teamMembers[$i]->gender,
						'userUniversity' => School::find($teamMembers[$i]->school_id)->name,
						'userImage' => $teamMembers[$i]->avatar);
			}
			
			$response = array( 
					'result' => array(
						'code' =>0, 'message' => 'no problem'), 
					'team' => $teamDetail,
					'teamMemberList' => $teamMemberList);
			return Responses::json($response);
		}
		else 
		{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}