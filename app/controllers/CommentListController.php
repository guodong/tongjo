<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class CommentListController extends BaseController {

	public function index()
	{
		$project = Project::whereRaw('id = ?', array(Input::get('projectId')))->first();
		if ($project)
		{
			$comments = $project->comments;
			$count = count($comments);
			if ($count != 0)
			{	
				for ($i = 0 ; $i <= $count-1; $i++)
				{
					$CommentList[$i] = array( 
						'commentUserId' => $comments[$i]->user_id,
						'commentUserName'=> User::find($comments[$i]->user_id)->realname,
						'commentUserImage' => User::find($comments[$i]->user_id)->avatar,
						'commentText' => $comments[$i]->content,
						'commentDate' => date($comments[$i]->created_at));
				}
			
				$response = array( 
					'result' => array(
						'code' =>0, 'message' => 'no problem'), 
					'count' => $count,
					'commentList' => $CommentList);
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
	
	public function store()
	{
		
		date_default_timezone_set('Asia/Shanghai');
		$record = new Comment();
		$record->user_id = (int)Input::get("userId");
		$record->project_id = (int)Input::get("projectId");
		$record->content = Input::get("commentText");
		return Input::get();
		/*foreach ($tmp as $k=>$v){
			if ($k == 'userId')
				$record->user_id = (int)$v;
		    if ($k == 'projectId')
				$record->project_id = (int)$v;
			if ($k == 'commentText')
				$record->content = $v;
		}*/
		$record->save();
		if (isset($record->user_id) && isset($record->project_id) && isset($record->content))
			return Responses::json(array(
					'result' => array(
							'code' =>0, 'message' => 'no problem')));
		else 
		{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}	
}