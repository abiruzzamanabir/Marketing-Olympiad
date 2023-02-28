<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FrontendController extends Controller
{
    public function showHomePage()
    {
        // $clients = Client::get();
        return view('frontend.pages.app', [
            // 'all_client' => $clients,
        ]);
    }
}