<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antibots\AntiBot;

class IpCheckController extends Controller
{
    public function validate_address()
    {

        $ret_val = AntiBot::validateIpAddress();
        if ($ret_val)
        {
            return response()->json([
                'ret_val' => true,
                'error' => null,
            ]);
        }
        return response()->json([
            'ret_val' => true,
            'error' => "Client ip address is blocked or banned.",
        ]);
    }
}
