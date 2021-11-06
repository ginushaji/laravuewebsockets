<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $userIp = $request->ip();
        $locationData = Location::get($userIp);
//        $locationData = Location::get('192.161.177.20');

        dd($locationData);
    }
}
