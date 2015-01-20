<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class TeamListController extends BaseController {

	public function index()
	{
		$project = Project::whereRaw('id = ?', array(Input::get('projectId')))->first();
		if ($project)
		{
			$teams = $project->teams;
			$count = count($teams);
			if ($count != 0)
			{	
				for ($i = 0 ; $i <= $count-1; $i++)
				{
					$teamFounder = User::find($teams[$i]->user_id);
					$teamList[$i] = array( 
						'teamFounderId' => $teams[$i]->user_id,
						'teamName'=> $teams[$i]->name,
						'teamFounderName' => $teamFounder->realname,
						'teamFounderIamge' => $teamFounder->avatar,
						'teamFounderSchool' => School::find($teamFounder->school_id)->name,
						'teamCreatedDate' => date($teams[$i]->created_at),
						'teamMemberAll' => $teams[$i]->teammember_all,
						'teamMemberNow' => $teams[$i]->teammember_current);
				}
			
				$response = array( 
					'result' => array(
						'code' =>0, 'message' => 'no problem'), 
					'count' => $count,
					'teamList' => $teamList);
				return Responses::json($response);
			}
			else 
			{
				return Responses::json(array(
					'result' => array(
						'code' =>0, 'message' => 'no problem'),
					'count' => 0));
			}
		}
		else
		{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}