<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscriberJob extends Job
{
    protected $dataReceipt;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dataReceipt)
    {
        $this->dataReceipt = $dataReceipt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('mails.newsletter', ['email' => $this->dataReceipt->email, 'name' => $this->dataReceipt->name], function ($message) {
            $message->to($this->dataReceipt->email, $this->dataReceipt->name)->subject('NEWSLETTER - '.Carbon::now()->format('d/m/Y'));
        });
    }
}
