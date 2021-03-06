<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class HomePageController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('id = ?', array(Input::get('userId')))->first();
		$joinedteams = $user->joinedTeams;
		$joinedprojects = NULL;
		if (count($joinedteams) != 0)
		{
			for ($i =0; $i < count($joinedteams); $i++)
			{
				$joinedprojects[$i] = $joinedteams[$i]->project;
				if ($joinedprojects[$i]->user_id == $user->id)
				unset($joinedprojects[$i]);
			}
			$joinedprojects = array_unique($joinedprojects);
			sort($joinedprojects);
		}
		$teamcount =  count($joinedteams);
		$projectcount = count($joinedprojects);
		$labelArray = [];
		
		if ($user)
		{
			$userinfo = array(
				'userId' => $user->id,
				'userEmail' => $user->email,
				'userRealName' => $user->realname,
				'userGender' => $user->gender,
				'userUniversity' => School::find($user->school_id)->name,
				'userImage' => $user->avatar
			);
			$userLabelCount = count($user->tags);
			if ($userLabelCount)
				for ($i = 0; $i < $userLabelCount; $i++)
					$labelArray[$i] = array(
						'labelId' => $user->tags[$i]->id,
						'labelName' => Tag::find($user->tags[$i]->id)->name
					);
		}
		
		$userProjectList = NULL;
		//$userTeamList = NULL;
		if ($projectcount != 0)
		{
			for ($j = 0; $j <= $projectcount - 1; $j++)
			{
				$joinedProjectList[$j] = array(
						'projectId' => $joinedprojects[$j]->id,
						'projectName' => $joinedprojects[$j]->name,
						'projectImage' => $joinedprojects[$j]->image,
						'projectCreatedDate' => date($joinedprojects[$j]->created_at),
						'projectEndDate' => $joinedprojects[$j]->deadline,
						'projectFounderId' => $joinedprojects[$j]->user_id,
						'projectFounderName' => User::find($joinedprojects[$j]->user_id)->realname,
						'projectFounderImage' => User::find($joinedprojects[$j]->user_id)->avatar,
						'projectFounderUniversityId' => User::find($joinedprojects[$j]->user_id)->school_id,
						'projectFounderUniversityName' => School::find(User::find($joinedprojects[$j]->user_id)->school_id)->name,
						'projectLabel' => $joinedprojects[$j]->categorys->first()->name,
						'projectText' => $joinedprojects[$j]->description,
						'teamNumber' => count($joinedprojects[$j]->teams),
					    'commentNumber' => count($joinedprojects[$j]->comments)
						);
				}
				$userProjectList = $joinedProjectList;	
		}
		
		/*if ($teamcount != 0)
		{
			for ($l = 0; $l <= count($joinedteams) - 1; $l++)
			{
				$joinedTeamList[$l] = array(
						'teamId' => $joinedteams[$l]->id,
						'projectId' => $joinedteams[$l]->project_id,
						'teamFounderId' => $joinedteams[$l]->user_id,
						'teamName' => $joinedteams[$l]->name,
						'teamFounderName' => User::find($joinedteams[$l]->user_id)->realname,
						'teamFounderImage' => User::find($joinedteams[$l]->user_id)->avatar,
						'teamFounderSchool' => School::find(User::find($joinedteams[$l]->user_id)->school_id)->name,
						'teamCreatedDate' => date($joinedteams[$l]->created_at),
						'teamMemberAll' => count($joinedteams[$l]->teams),
						'teamMemberNow' => count($joinedteams[$l]->members),
						'teamDeadlineDate' => $joinedteams[$l]->signup_time,
						'teamDescription' => $joinedteams[$l]->description);
				}
				$userTeamList = $joinedTeamList;	
		}*/
		if ($user)
		{
			if ($userProjectList)
			{
				$response = array('result' => array('code' =>0, 'message' => 'no problem'),
						'userBasicInfo' => $userinfo,
						'projectCount' => $projectcount,
						'userProjectList' => $userProjectList,
						//'teamCount' => $teamcount,
						//'userTeamList' => $userTeamList,
						'userLabelCount' => $userLabelCount,
						'userLabelArr' => $labelArray);
						return Responses::json($response);
			}
			/*else if ($userTeamList)
			{
				$response = array('result' => array('code' =>0, 'message' => 'no problem'),
						'userBasicInfo' => $userinfo,
						'projectCount' => $projectcount,		
						'teamCount' => $teamcount,
						'userTeamList' => $userTeamList,
						'userLabelCount' => $userLabelCount,
						'userLabelArr' => $labelArray);
				return Responses::json($response);
			}*/
			else
			{
				$response = array('result' => array('code' =>0, 'message' => 'no problem'),
						'userBasicInfo' => $userinfo,
						'projectCount' => $projectcount,
						//'teamCount' => $teamcount,
						'userLabelCount' => $userLabelCount,
						'userLabelArr' => $labelArray);
				return Responses::json($response);
			}
				
		}
		else 
		{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}