<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class ProjectListController extends BaseController {

	public function index()
	{
		$category = Category::whereRaw('id = ?', array(Input::get('id')))->first();
		$projects = $category->projects;
		$count = count($projects);
		for ($i = 0 ; $i <= $count-1; $i++)
		{
			$projectCreator = $projects[$i]->creator;
			$projectList[$i] = array( 'projectID' => $projects[$i]->id,
									  'projectName' => $projects[$i]->name,
									  'projectImage' => $projects[$i]->pic,
									  'projectCreatDate' => date($projects[$i]->created_at),
									  'projectEndDate' => $projects[$i]->deadline,
									  'projectFounderId' => $projects[$i]->user_id,
					                  'projectFounderName' => $projects[$i]->creator->realname,
									  'projectFounderImage' => $projects[$i]->creator->avatar,
									  'projectFounderUniversityId' => School::find($projects[$i]->creator->id)->id,
									  'projectFounderUniversityName' => School::find($projects[$i]->creator->id)->name,
									  'projectLabel' => $projects[$i]->type,
					                  'projectText' => $projects[$i]->description
									);
		}
		if($projectList){
			$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
							   'categoryId' => $category->id,
							   'count' => $count,
					           'projectList' => $projectList
	                          );
			return Responses::json($response);
		}else{
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}

}