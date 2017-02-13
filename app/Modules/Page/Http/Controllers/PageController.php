<?php
namespace App\Modules\Page\Http\Controllers;

use Illuminate\Routing\Controller;
use Theme;

class PageController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index($page){
		return Theme::view('page::'.$page);
	}

}
