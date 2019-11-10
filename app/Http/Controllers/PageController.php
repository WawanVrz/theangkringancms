<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\SysContent;
use App\SysWebsite;
use App\Http\Controllers\Controller;
use App\ContentFlatProduct;
use App\ReviewsProduct;
use Route;
use Auth;
use App;
use Session;
use Config;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class PageController extends FrontendController
{

    function __construct(Request $request, Route $route)
    {
        parent::__construct($request, $route);
    }

    public function index()
    {
        $website = SysWebsite::find(session('sys_website_scope'));
        $code = $website->locale;
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);

        return view('frontend.pages.home', compact('jsonString','website'));
    }
}
