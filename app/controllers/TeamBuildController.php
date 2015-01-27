<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class TeamBuildController extends BaseController {
	
	public function store()
	{
		date_default_timezone_set('Asia/Shanghai');
		$record = new Team();
		$record->user_id = (int)Input::get("TeamFounderId");
		$record->project_id = (int)Input::get("projectId");
		$record->name= Input::get("teamName");
		$record->teammember_all = Input::get("teamMemberAll");
		$record->signup_time = Input::get("teamEndDate");
		$record->description = Input::get("teamDescription");
		$record->is_solo = 0;
		$record->status = 1;
		$record->is_signup = 0;
		//return Input::get();
		/*foreach ($tmp as $k=>$v){
			if ($k == 'userId')
				$record->user_id = (int)$v;
		    if ($k == 'projectId')
				$record->project_id = (int)$v;
			if ($k == 'commentText')
				$record->content = $v;
		}*/
		$record->save();
		return $record;
		if (isset($record->user_id) && isset($record->project_id) && isset($record->description))
			return Responses::json(array(
					'result' => array(
							'code' =>0, 'message' => 'no problem')));
		else 
		{
			return Responses::json(array('result' => array('code' => 1, 'message' => 'problem 1')));
		}
	}	
}