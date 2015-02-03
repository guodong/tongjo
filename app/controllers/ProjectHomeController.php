<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class ProjectHomeController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('id = ?', array(Input::get('userId')))->first();
		$categoryId =  Input::get('categoryId');
		$customId = Input::get("customId");
		
		if (Input::get('userId') != 0)
		{
			if ($categoryId == 0)
			{
				$projects = Project::Paginate(20)->take(6);
				$adProjects = [];
				$projectList = NULL;
				
				if ($customId == 1)
				{
					for ($i = 0 ; $i <= 2; $i++)
					{
						$projectCreator = $projects[$i]->creator;
						$adProjects[$i] = array( 
								'projectID' => $projects[$i]->id,
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
								'commentNumber' => 0);
					}
					for ($i = 0 ; $i <= 5; $i++)
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
								'commentNumber' => 0);
					}
					
				}
				else if ($customId == 2)
				{
					for ($i = 0 ; $i <= 5; $i++)
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
								'commentNumber' => 0);
					}
				}
				else if ($customId == 3)
				{
					for ($i = 0 ; $i <= 5; $i++)
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
								'commentNumber' => 0);
					}
				}
				else if ($customId == 4)
				{
					for ($i = 0 ; $i <= 5; $i++)
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
								'commentNumber' => 0);
					}
				}	
				else 
				{
					$projectList = NULL;
				}
			}					
			if ($projectList){
				$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
								   'categoryId' => $categoryId,
								   'customId' => $customId,
							       'adProjects' => $adProjects,
							       'projectList' => $projectList,
	                          	 );
				return Responses::json($response);
			}
			else{
				return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			}
		}
	}
	
}