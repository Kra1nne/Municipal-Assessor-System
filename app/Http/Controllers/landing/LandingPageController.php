<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingpage()
    {
        return view('content.feature.landingpage');
    }
    public function about()
    {
        return view('content.feature.about');
    }
    public function services()
    {
        return view('content.feature.services');
    }
    public function contact()
    {
        return view('content.feature.contact');
    }
}
