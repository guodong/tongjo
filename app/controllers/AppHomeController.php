<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class AppHomeController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('id = ?', array(Input::get('userId')))->first();
		if (Input::get('userId') != 0)
		{
			$projects = Project::Paginate(20)->take(4)->get();
			return $projects;
			$count = count($projects);
			$projectList = NULL;
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