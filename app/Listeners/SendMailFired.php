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
       $customer = $event->customer;
        
       $customer = Customer::where('id',$event->customer->id)->first();
        Mail::send( 'email.user_notification', ['firstName' => $customer->firstName, 'lastName' => $customer->lastName], function($message) use ($customer) {
            $message->from('admin@bands.com','Admin');
            $message->to($customer->firstName,$customer->lastName);

        $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }

}
