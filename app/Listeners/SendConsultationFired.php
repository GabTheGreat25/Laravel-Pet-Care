<?php

namespace App\Listeners;

use App\Events\SendConsultation;
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
 
        Mail::send( 'email.consultation_notification', ['dateConsult' => $consultations->dateConsult, 'fees' => $consultations->fees,'comment' => $consultations->comment,], function($message) use ($consultations) {
            $message->from('petcare@yahoo.com.ph');
            $message->to(DB::table('consultations')->rightJoin('animals', 'consultations.animal_id', '=', 'animals.id')->leftJoin('customers', 'customers.id', '=', 'animals.customer_id')->leftJoin('users', 'users.id', '=', 'customers.user_id')            ->orderBy("consultations.created_at", "DESC")->pluck('users.email')->first());
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}