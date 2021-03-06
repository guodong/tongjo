<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class ProjectListController extends BaseController {

	public function index()
	{
		$projects = Project::Paginate(20);
		if (Input::get('categoryId') != 0 && Input::get('categoryId') != NULL)
		{
			$projects = $category->projects;
			$count = count($projects);
			for ($i = 0 ; $i <= $count-1; $i++)
			{
				$projectCreator = $projects[$i]->creator;
				$projectList[$i] = array( 'projectID' => $projects[$i]->id,
									  	  'projectName' => $projects[$i]->name,
									      'projectImage' => $projects[$i]->image,
									  	  'projectCreatedDate' => date($projects[$i]->created_at),
									      'projectEndDate' => $projects[$i]->deadline,
									      'projectFounderId' => $projects[$i]->user_id,
					                      'projectFounderName' => $projects[$i]->creator->realname,
									      'projectFounderImage' => $projects[$i]->creator->avatar,
									      'projectFounderUniversityId' => $projects[$i]->creator->school_id,
									      'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
									      'projectLabel' => $projects[$i]->categorys->first()->name,
					                      'projectText' => $projects[$i]->description,
									      'teamNumber' => count($projects[$i]->teams),
										  'commentNumber' => 0
									    );
			}
			if($projectList){
				$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
							       'categoryId' => $category->id,
							       'count' => $count,
					               'projectList' => $projectList
	                          	 );
				return Responses::json($response);
			}
			else{
				return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			}
		}
		else
		{
			$projects = Project::Paginate(20);
			$count = count($projects);
			for ($i = 0 ; $i <= $count-1; $i++)
			{
				$projectCreator = $projects[$i]->creator;
				$projectList[$i] = array( 'projectID' => $projects[$i]->id,
									  	  'projectName' => $projects[$i]->name,
									      'projectImage' => $projects[$i]->image,
									  	  'projectCreatedDate' => date($projects[$i]->created_at),
									      'projectEndDate' => $projects[$i]->deadline,
										  'projectFounderId' => $projects[$i]->creator->id,
					                      'projectFounderName' => $projects[$i]->creator->realname,
									      'projectFounderImage' => $projects[$i]->creator->avatar,
									      'projectFounderUniversityId' => $projects[$i]->creator->school_id,
									      'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
									      'projectLabel' => $projects[$i]->categorys->first()->name,
					                      'projectText' => $projects[$i]->description,
						                  'teamNumber' => count($projects[$i]->teams),
										  'commentNumber' => 0
									    );
			}
			if($projectList){
				$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
							       'categoryId' => 0,
							       'count' => $count,
					               'projectList' => $projectList
	                          	 );
				return Responses::json($response);
			}
			else{
				return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			}
		}
	}
	
}