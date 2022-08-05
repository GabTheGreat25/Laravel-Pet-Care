<?php

namespace App\Listeners;

use App\Events\SendConsultation;
use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\consultations;
use Mail;
use DB;
class SendConsultationFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendConsultation  $event
     * @return void
     */
    public function handle(SendConsultation $event)
    {

       $consultations = $event->consultations;
       $consultations = consultations::where('id',$event->consultations->id)->first();
 
        Mail::send( 'email.user_notification', ['fname' => $consultations->firstName, 'lname' => $consultations->lastName,'email' => $consultations->email,], function($message) use ($consultations) {
            $message->from('petcare@yahoo.com.ph');
            $message->to($consultations->email, $consultations->firstName, $consultations->lastName);
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}