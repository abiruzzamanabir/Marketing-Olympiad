<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class NotificationController extends Controller
{
    public function getSomeNotificatinData(){

        $notification = Notification::where(['status'=>1,'is_archive'=>0])->get();
        return $notification;
    }

    public function CountNotification(){

        return Notification::where(['status'=>1,'is_archive'=>0])->count();
    }

    public function singleNotification($id){
        $singleNotification =   Notification::where(['id'=>$id])->first();
        return view('showSingleNotification',compact('singleNotification'));
    }

    public function allNotification(){
        $allNotification =  Notification::where(['status'=>1,'is_archive'=>0])->get();
        return view('allNotification',compact('allNotification'));
    }
}
