<?php

namespace App\Listeners;
use App\Events\SendMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Mail;
class SendMailFired
{
    public function __construct()
    {
        
    }
    public function handle(SendMail $event)
    {
        $user = User::find($event->userId)->toArray();
        //dd($user);
        Mail::send('emails.addproduct', $user, function($message) use ($user) {
            $message->to(  trim(preg_replace('/\s\s+/', ' ',$user['email'] )));
            $message->subject('Event New Product Added');
        });
    }
}