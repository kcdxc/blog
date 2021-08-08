<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailToSubscriberJob;
use App\Models\User;

class NewsletterController extends Controller
{
    public function sendNotification()
    {
        $users = User::all();
        foreach ($users as $user) {
            dispatch(new SendEmailToSubscriberJob($user));
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully to added send mail to Queue.',
            'data' => null
        ]);
    }
}
