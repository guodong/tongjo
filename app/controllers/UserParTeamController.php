<?php

use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;
class UserParTeamController extends BaseController {
	
	public function index()
	{
		$user_id = (int)Input::get("userId");	
		$user = User::find($user_id);
		if ($user){
			$teams = $user->joinedTeams;
			$teamList = [];
			for ($i = 0 ; $i < count($teams); $i++)
			{
				$teamFounder = User::find($teams[$i]->user_id);
				$teamList[$i] = array(
						'teamId' => $teams[$i]->id,
						'projectId' => $teams[$i]->project_id,
						'teamFounderId' => $teams[$i]->user_id,
						'teamName'=> $teams[$i]->name,
						'teamFounderName' => $teamFounder->realname,
						'teamFounderImage' => $teamFounder->avatar,
						'teamFounderSchool' => School::find($teamFounder->school_id)->name,
						'teamCreatedDate' => date($teams[$i]->created_at),
						'teamMemberAll' => $teams[$i]->teammember_all,
						'teamMemberNow' => count($teams[$i]->members),
						'teamDeadlineDate' => date($teams[$i]->signup_time),
						'teamDescription' => $teams[$i]->description);
			}
			$response = array( 
					'result' => array(
						'code' =>0, 'message' => 'no problem'), 
					'count' => count($teams),
					'teamList' => $teamList);
			return Responses::json($response);
		}else{
			return json_encode(array('error'=>1, 'msg'=>'no user'));
		}
	}

}
