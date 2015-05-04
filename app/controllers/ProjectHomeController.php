<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class ProjectHomeController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('id = ?', array(Input::get('userId')))->first();
		$category = Category::whereRaw('id = ?', array(Input::get('categoryId')))->first();
		$categoryId =  (int) Input::get('categoryId');
		$customId = (int) Input::get("customId");
		
		if (Input::get('userId') != 0)
		{
			//$projects = Project::Paginate(10);
			$adProjects = Project::orderByRaw("RAND()")->get();
			//return Category::find($adProjects[4]->categorys->first()->fid)->name;
			for ($i = 0 ; $i <= 2; $i++)
			{
				if ($adProjects[$i]->categorys->first()->fid != 0 && $adProjects[$i]->id != 0)
				{
					$adProjectList[$i] = array( 'projectId' => $adProjects[$i]->id,
						'projectName' => $adProjects[$i]->name,
						'projectImage' => $adProjects[$i]->image,
						'projectCreatedDate' => date($adProjects[$i]->created_at),
						'projectEndDate' => $adProjects[$i]->deadline,
						'projectFounderId' => $adProjects[$i]->user_id,
						'projectFounderName' => $adProjects[$i]->creator->realname,
						'projectFounderImage' => $adProjects[$i]->creator->avatar,
						'projectFounderUniversityId' => $adProjects[$i]->creator->school_id,
						'projectFounderUniversityName' => School::find($adProjects[$i]->creator->school_id)->name,
						'projectLabel' => Category::find($adProjects[$i]->categorys->first()->fid)->name,
						'projectText' => $adProjects[$i]->description,
						'teamNumber' => count($adProjects[$i]->teams),
						'commentNumber' => count($adProjects[$i]->comments));
				}
				
			}
			
			$projectList = NULL;			
			if ($categoryId == 0)
			{
				if ($customId == 1)
				{
					$projects = Project::orderByRaw("RAND()")->get();
					for ($i = 0 ; $i <= 9; $i++)
					{
						if ($projects[$i]->categorys!= NULL && $projects[$i]->categorys->first()->fid != 0 && $projects[$i]->id != 0)
						{
							$projectList[$i] = array( 'projectId' => $projects[$i]->id,
								'projectName' => $projects[$i]->name,
								'projectImage' => $projects[$i]->image,
								'projectCreatedDate' => date($projects[$i]->created_at),
								'projectEndDate' => $projects[$i]->deadline,
								'projectFounderId' => $projects[$i]->user_id,
								'projectFounderName' => $projects[$i]->creator->realname,
								'projectFounderImage' => $projects[$i]->creator->avatar,
								'projectFounderUniversityId' => $projects[$i]->creator->school_id,
								'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
								'projectLabel' => Category::find($projects[$i]->categorys->first()->fid)->name,
								'projectText' => $projects[$i]->description,
								'teamNumber' => count($projects[$i]->teams),
								'commentNumber' => count($projects[$i]->comments));
						}
					}
					
				}
				else if ($customId == 2)
				{
					$projects = Project::orderBy('created_at', 'desc')->get();
					for ($i = 0 ; $i <= 9; $i++)
					{
						$projectList[$i] = array( 'projectId' => $projects[$i]->id,
								'projectName' => $projects[$i]->name,
								'projectImage' => $projects[$i]->image,
								'projectCreatedDate' => date($projects[$i]->created_at),
								'projectEndDate' => $projects[$i]->deadline,
								'projectFounderId' => $projects[$i]->user_id,
								'projectFounderName' => $projects[$i]->creator->realname,
								'projectFounderImage' => $projects[$i]->creator->avatar,
								'projectFounderUniversityId' => $projects[$i]->creator->school_id,
								'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
								'projectLabel' => Category::find($projects[$i]->categorys->first()->fid)->name,
								'projectText' => $projects[$i]->description,
								'teamNumber' => count($projects[$i]->teams),
								'commentNumber' => count($projects[$i]->comments));
					}
				}
				else if ($customId == 3)
				{
					$projects = Project::orderBy('viewcount', 'desc')->get();
					for ($i = 0 ; $i <= 9; $i++)
					{
						$projectList[$i] = array( 'projectId' => $projects[$i]->id,
								'projectName' => $projects[$i]->name,
								'projectImage' => $projects[$i]->image,
								'projectCreatedDate' => date($projects[$i]->created_at),
								'projectEndDate' => $projects[$i]->deadline,
								'projectFounderId' => $projects[$i]->user_id,
								'projectFounderName' => $projects[$i]->creator->realname,
								'projectFounderImage' => $projects[$i]->creator->avatar,
								'projectFounderUniversityId' => $projects[$i]->creator->school_id,
								'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
								'projectLabel' => Category::find($projects[$i]->categorys->first()->fid)->name,
								'projectText' => $projects[$i]->description,
								'teamNumber' => count($projects[$i]->teams),
								'commentNumber' => count($projects[$i]->comments));
					}
				}
				else if ($customId == 4)
				{
					$projects = Project::orderByRaw("RAND()")->get();
					for ($i = 0 ; $i <= 9; $i++)
					{
						$projectList[$i] = array( 'projectId' => $projects[$i]->id,
								'projectName' => $projects[$i]->name,
								'projectImage' => $projects[$i]->image,
								'projectCreatedDate' => date($projects[$i]->created_at),
								'projectEndDate' => $projects[$i]->deadline,
								'projectFounderId' => $projects[$i]->user_id,
								'projectFounderName' => $projects[$i]->creator->realname,
								'projectFounderImage' => $projects[$i]->creator->avatar,
								'projectFounderUniversityId' => $projects[$i]->creator->school_id,
								'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
								'projectLabel' => Category::find($projects[$i]->categorys->first()->fid)->name,
								'projectText' => $projects[$i]->description,
								'teamNumber' => count($projects[$i]->teams),
								'commentNumber' => count($projects[$i]->comments));
					}
				}	
				else 
				{
					$projectList = NULL;
				}
			}
			
			else if ($categoryId != 0 && $categoryId != NULL && $customId == 0)
			{
				$projects = [];
	    		if (count($category->children)){
	        		for ($i = 0 ; $i <= count($category->children)-1; $i++)
	        			$projects[$i] = Project::find($category->children[$i]->id);
	        	}
	    		else{
	        		$projects = $category->projects->toArray();
	    		}
				$count = count($projects);
				for ($i = 0 ; $i <= $count-1; $i++)
				{
					$projectList[$i] = array( 'projectId' => $projects[$i]->id,
							'projectName' => $projects[$i]->name,
							'projectImage' => $projects[$i]->image,
							'projectCreatedDate' => date($projects[$i]->created_at),
							'projectEndDate' => $projects[$i]->deadline,
							'projectFounderId' => $projects[$i]->user_id,
							'projectFounderName' => $projects[$i]->creator->realname,
							'projectFounderImage' => $projects[$i]->creator->avatar,
							'projectFounderUniversityId' => $projects[$i]->creator->school_id,
							'projectFounderUniversityName' => School::find($projects[$i]->creator->school_id)->name,
							'projectLabel' => Category::find($categoryId)->name,
							'projectText' => $projects[$i]->description,
							'teamNumber' => count($projects[$i]->teams),
							'commentNumber' => count($projects[$i]->comments));
				}
			}
			
			else if ($categoryId != 0 && $categoryId != NULL && $customId != 0) {
				return Responses::json(array('result' => array('code' =>2, 'message' => 'Parameters error!')));
			}
			
			else {
				$projectList = NULL;
			}
			
			if ($projectList && $categoryId == 0){
				$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
								   'categoryId' => $categoryId,
								   'customId' => $customId,
							       'adProjects' => $adProjectList,
							       'projectList' => $projectList);
				return Responses::json($response);
			}
			else if ($projectList && $categoryId != 0 && $categoryId != NULL)
			{
				$response = array( 'result' => array('code' =>0, 'message' => 'no problem'),
						'categoryId' => $categoryId,
						'customId' => $customId,
						'projectList' => $projectList);
				return Responses::json($response);
			}
			else{
				return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			}
		}
		else {
			return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
		}
	}
	
}