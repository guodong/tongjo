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
		$comment = Comment::create(Input::get());
		return Responses::json(array(
					'result' => array(
						'code' =>0, 'message' => 'no problem'),
					));
	}
	
}