<?php
use Illuminate\Support\Facades\Response as Responses;
use Illuminate\Support\Facades\Input;

class AppHomeController extends BaseController {

	public function index()
	{
		$user = User::whereRaw('id = ?', array(Input::get('userId')))->first();
		if (Input::get('userId') != 0)
		{
			$projects = Project::Paginate(20)->take(4);
			$adList = NULL;
			$selectedlist = NULL;
			$hottestlist = NULL;
			$lateetlist = NULL;
			for ($i = 0 ; $i <= 2; $i++)
			{
				$projectCreator = $projects[$i]->creator;
				$adList[$i] = array( 'projectID' => $projects[$i]->id,
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
			for ($i = 0 ; $i <= 3; $i++)
			{
			$projectCreator = $projects[$i]->creator;
			$selectedList[$i] = array( 'projectID' => $projects[$i]->id,
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
			for ($i = 0 ; $i <= 3; $i++)
			{
			$projectCreator = $projects[$i]->creator;
			$hottestList[$i] = array( 'projectID' => $projects[$i]->id,
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
			for ($i = 0 ; $i <= 3; $i++)
			{
			$projectCreator = $projects[$i]->creator;
			$latestList[$i] = array( 'projectID' => $projects[$i]->id,
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
			if($adList && $selectedList && $hottestList && $latestList){
				$response = array( 'result' => array('code' =>0, 'message' => 'no problem'), 
							       'adList' => $adList,
							       'selectedList' => $selectedList,
					               'hottestList' => $hottestList,
								   'latestList' => $latestList
	                          	 );
				return Responses::json($response);
			}
			else{
				return Responses::json(array('result' => array('code' =>1, 'message' => 'problem 1')));
			}
		}
	}
	
}