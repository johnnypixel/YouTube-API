<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;
use Input;

class VidsController extends Controller
{
    
    public function index()
	{
		//container for video results
		$vids_array = array();

		 return view('vids', ['videos' => $vids_array]);
	}

    public function indexPost(Request $request)
	{
		//container for video results
		$vids_array = array();

		//process form
		if (!empty($request->input('query'))) {
			$q = $request->input('query');
		
			
			//connect to youtube API
			$client = new Google_Client();
			$client->setApplicationName("Client_Library_Examples");
			$client->setDeveloperKey("AIzaSyAZAbj9pjY9Q9701J_VL0iHlJr7fchvi8A");
			$service = new Google_Service_YouTube($client);

			//pass parameters here
			$optParams = array(
				'type' 		=> 'video',
	  			'q' 		=> $q,
	  			'maxResults'=> 20
			);

			//pass response ino container array and pass on to view layer
			$results = $service->search->listSearch('id,snippet',$optParams);
			
			foreach ($results as $item) {
			  array_push($vids_array,  $item->id->videoId);
			}

 			return response()->json(['success'=>'Search Successful', 'vids' => $vids_array]);
		}
		
	}

    public function show($term)
	{
		return $term;
	}
}
