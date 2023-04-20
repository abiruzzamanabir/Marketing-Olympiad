<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use RahulHaque\AdnSms\Facades\AdnSms;

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
    public static function singleSMSSend($mobile, $msg)
    {
        try {
            $response = AdnSms::to($mobile)
                ->message($msg)
                ->send();
            return $response->json();
        }catch (Exception $e){
            Log::error('Something is wrong to send sms, msg: '.$e->getMessage().' '.$e->getFile().' '.$e->getLine());
        }

    }
}
