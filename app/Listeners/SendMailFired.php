<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Customer;
use Mail;
class SendMailFired
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
     * @param  \App\Events\SenMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
         //dd($event);
        $customer = $event->customer;
       $customer = Customer::where('id',$event->customer->id)->first();
       $email = 'email@address.com';
        //dd($customer);
        Mail::send( 'email.user_notification', ['fname' => $customer->firstName, 'lname' => $customer->lastName,], function($message) use ($customer) {
            $message->from('meantonettemedalla@tup.edu.ph');
            $message->to('gabrielarafol.mendoza@tup.edu.ph');
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}