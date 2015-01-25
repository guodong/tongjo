<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class UserDetailController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('id = ?', array(Input::get('userId')))->first();
		$createdteams = $user->createdTeams;
		$joinedteams = $user->joinedTeams;
		if (count($joinedteams))
		{
			$num = count($joinedteams);
			for ($i = 0; $i < $num; $i++)
			{	
				if ($joinedteams[$i]->user_id == $user->id)
				unset($joinedteams[$i]);					
			}
			if (count($joinedteams) > 1)
				sort($joinedteams);
			return $joinedteams;
		}
		
		$createdprojects = $user->createdProjects;
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
		
		$teamcount = count($createdteams) + count($joinedteams);
		$projectcount = count($createdprojects) + count($joinedprojects);
		
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
		}
		if ($projectcount != 0)
		{
			if (count($createdprojects) != 0)
			{
				for ($i = 0; $i <= count($createdprojects)-1; $i++)
				{
					$createdProjectList[$i] = array(
						'projectId' => $createdprojects[$i]->id,
						'projectName' => $createdprojects[$i]->name,
						'projectImage' => $createdprojects[$i]->image,
						'projectCreatedDate' => date($createdprojects[$i]->created_at),
						'projectEndDate' => $createdprojects[$i]->deadline,
						'projectFounderId' => $user->id,
						'projectFounderName' => $user->realname,
						'projectFounderImage' => $user->avatar,
						'projectFounderUniversityId' => $user->school_id,
						'projectFounderUniversityName' => School::find($user->school_id)->name,
						'projectLabel' => $createdprojects[$i]->categorys->first()->name,
						'projectText' => $createdprojects[$i]->description,
						'teamNumber' => count($createdprojects[$i]->teams),
						'commentNumber' => count($createdprojects[$i]->comments)
					);
				}
				$userProjectList = $createdProjectList;
			}
			if (count($joinedprojects) != 0)
			{
				for ($j = 0; $j <= count($joinedprojects)-1; $j++)
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
			
					$userProjectList = array_merge($userProjectList , $joinedProjectList);			
			}	
		}
		if ($teamcount != 0)
		{
			if (count($createdteams) != 0)
			{
				for ($k = 0; $k <= count($createdteams) - 1; $k++)
				{
					$createdTeamList[$k] = array(
						'teamId' => $createdteams[$k]->id,
						'teamFounderId' => $user->id,
						'teamName' => $createdteams[$k]->name,
						'teamFounderName' => $user->realname,
						'teamFounderImage' => $user->avatar,
						'teamFounderSchool' => School::find($user->school_id)->name,
						'teamCreatedDate' => date($createdteams[$k]->created_at),
						'teamMemberAll' => count($createdprojects[$k]->teams),
						'teamMemberNow' => count($createdprojects[$k]->members)
						);
				 }
				 $userTeamList = $createdTeamList;
			}
			if (count($joinedteams) != 0)
			{
				for ($l = 0; $l <= count($joinedteams) - 1; $l++)
				{
					$joinedTeamList[$l] = array(
						'teamId' => $joinedteams[$l]->id,
						'teamFounderId' => $joinedteams[$l]->user_id,
						'teamName' => $joinedteams[$l]->name,
						'teamFounderName' => User::find($joinedteams[$l]->user_id)->realname,
						'teamFounderImage' => User::find($joinedteams[$l]->user_id)->avatar,
						'teamFounderSchool' => School::find(User::find($joinedteams[$l]->user_id)->school_id)->name,
						'teamCreatedDate' => date($joinedteams[$l]->created_at),
						'teamMemberAll' => count($joinedteams[$l]->teams),
						'teamMemberNow' => count($joinedteams[$l]->members)
						);
				 }
				 $userTeamList = array_merge($userTeamList , $joinedTeamList);
			 }
					
		}
		if ($user)
		{
			$response = array('result' => array('code' =>0, 'message' => 'no problem'),
				'userBasicInfo' => $userinfo,
				'projectCount' => $projectcount,
				'userProjectList' => $userProjectList,
				'teamCount' => $teamcount,
				'userTeamList' => $userTeamList);
			return Responses::json($response);
				
		}
		else 
		{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}